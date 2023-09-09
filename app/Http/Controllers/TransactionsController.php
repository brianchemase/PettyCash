<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    //

    public function getTransactionHistory()
        {
            $transactionHistory = DB::table('tbl_petty_cash_transactions')
                ->select(
                    'tbl_petty_cash_transactions.*', // Select all columns from tbl_petty_cash_transactions
                    'tbl_staff.first_name as f_staff_name', // Select the staff name from tbl_staff and alias it as staff_name
                    'tbl_staff.last_name as l_staff_name'
                )
                ->join('tbl_staff', 'tbl_petty_cash_transactions.staff_id', '=', 'tbl_staff.staff_id')
                ->orderBy('tbl_petty_cash_transactions.transaction_date', 'desc')
                ->get();


            $data = [
                'transactionHistory' => $transactionHistory,
                
                // Add more data to the array as needed
            ];

            return view ('admins.Transationshistorytable')->with($data);
        }

        public function getStaffTransactionHistory($staff_id)
            {
                $transactionHistory = DB::table('tbl_petty_cash_transactions')
                    ->select(
                        'tbl_petty_cash_transactions.*',
                        'tbl_staff.first_name as f_staff_name',
                        'tbl_staff.last_name as l_staff_name'
                    )
                    ->join('tbl_staff', 'tbl_petty_cash_transactions.staff_id', '=', 'tbl_staff.staff_id')
                    ->where('tbl_petty_cash_transactions.staff_id', $staff_id)
                    ->orderBy('tbl_petty_cash_transactions.transaction_date', 'desc')
                    ->get();

                return response()->json($transactionHistory);
            }

            public function getStaffWithdrawalLimit($staff_id)
            {
                

                $staffStatus = DB::table('tbl_staff')
                ->where('staff_id', $staff_id)
                ->select('account_status')
                ->first();

                if ($staffStatus) {
                    // Staff status found
                    $status = $staffStatus->account_status;
                
                    if ($status === 'active') {
                        // Staff is active
                        // Perform actions for active staff
                        $WithdrawalLimit = DB::table('tbl_petty_cash_transactions')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('balance')->first()->balance;
                    } else {
                        // Staff is not active
                        // Perform actions for non-active staff
                        $WithdrawalLimit ="0";
                        return response()->json(['withdrawal_limit' => $WithdrawalLimit, 'error' => 'Withdrawal Not possible, Account Inactive'], 404);
                    }
                } else {
                    // Staff not found
                    // Handle the case where the staff_id does not exist
                    $WithdrawalLimit ="0";
                    return response()->json(['withdrawal_limit' => $WithdrawalLimit, 'error' => 'Withdrawal Not possible, Account Inactive'], 404);
                }


                //return $WithdrawalLimit;
                if ($WithdrawalLimit) {
                    // If a withdrawal limit is found, return it in JSON response
                    return response()->json(['withdrawal_limit' => $WithdrawalLimit]);
                } else {
                    // If no withdrawal limit is found, return an appropriate JSON response
                    return response()->json(['error' => 'Withdrawal limit not found', 'withdrawal_limit' => $WithdrawalLimit], 404);
                }

            }

            public function processPayment(Request $request)
                {
                    // Validate the input data
                    $request->validate([
                        'staff_id' => 'required',
                        'amount' => 'required|numeric',
                        'purpose' => 'required',
                        'access_pin' => 'required',
                        'phone_number' => 'required|numeric',
                    ]);

                    // Retrieve the input data
                    $staff_id = $request->input('staff_id');
                    $amount = $request->input('amount');
                    $purpose = $request->input('purpose');
                    $access_pin = $request->input('access_pin');
                    $phoneNumber = $request->input('phone_number');

                    $System_pin = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('access_pin')->first()->access_pin;
                    // check system pin
                    if($access_pin != $System_pin)
                    {
                        return response()->json([
                            'status_code'=> 401,
                            'message' => "Invalid Transaction Pin",
                        ]);

                    }



                    $WithdrawalLimit = DB::table('tbl_petty_cash_transactions')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('balance')->first()->balance;
                    //check withdrawal limit
                    if ($amount >= $WithdrawalLimit) {
                        return response()->json([
                            'status_code'=> 400,
                            'message' => "Invalid Limit. Current Balance is $WithdrawalLimit",
                        ]);
                    }

                    // Add your payment processing logic here

                    $newbalance=$WithdrawalLimit-$amount;
                    $TransactionDate = Carbon::now();


                    //update transation history
                $insertTransaction = DB::table('tbl_petty_cash_transactions')->insert([
                    'staff_id' => $staff_id,
                    'transaction_date' => $TransactionDate,
                    'purpose' => $purpose,
                    'description' => $purpose.":".$phoneNumber,
                    'amount' =>  $amount,
                    'balance' => $newbalance,
                    'transaction_type' =>  "withdrawal",
                    'created_at' => $TransactionDate, 
                ]);

                    $client_fname = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('first_name')->first()->first_name;
                    $phone = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('phone')->first()->phone;

                    $message="Dear $client_fname,\nYour have succesfully withdrawnn KES $amount for Purpose: $purpose.\nYour New walet balance is KES $newbalance";
                    $Notify = $this->SendNotification($phone, $message);



                    // Return a response
                    return response()->json([
                        'status_code'=> 200,
                        'message' => 'Payment processed successfully',
                        'staff_id' => $staff_id,
                        'amount' => $amount,
                        'NewBalance' => $newbalance,
                    ]);
                }

            public function SendNotification($phone, $message)
            {
                // Define the JSON data to send
                $data = [
                    "phone" => $phone,
                    "message" => $message,
                ];

                    $apikey="6bffdc7405dd019325db9cfe3ec093e0";
                    $shortcode="TextSMS";
                    $partnerID="6712";
                    //$partnerID="04";
                    $serviceId=0;

                        $smsdata=array(
                            "apikey" => $apikey,
                            "shortcode" => $shortcode,
                            "partnerID"=> $partnerID,
                            "mobile" => $phone,
                            "message" => $message,
                            //"serviceId" => $serviceId,
                            //"response_type" => "json",
                            );
                            
                        $smsdata_string=json_encode($smsdata);
                        //echo $smsdata_string."\n";

                        $smsURL="https://sms.textsms.co.ke/api/services/sendsms/";

                        //POST
                        $ch=curl_init($smsURL);
                        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
                        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
                        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,$smsdata_string);
                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                            'Content-Type: application/json',
                            'Content-Length: '.strlen($smsdata_string)
                            )	
                        );
                        $response=curl_exec($ch);
                        $err = curl_error($ch);
                        curl_close($ch);

                // Output the response from the endpoint
            // return "Response: " . $response;
            }
}
