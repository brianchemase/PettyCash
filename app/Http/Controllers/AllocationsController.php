<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AllocationsController extends Controller
{
    //
    public function Fundallocation(Request $request)
    {

        $staffData = DB::table('tbl_staff')
        ->where('account_status', 'active')
        ->get();


        //return $clients_list;
        if(isset($_GET['q']))
        {    
            $staff_id=$_GET['q'];
            $details=$_GET['q'];

            $allocation = DB::table('tbl_petty_cash_transactions')->where('staff_id', $staff_id)->first();

            if ($allocation) {
                // Record exists, return its values
                $fund_balance = DB::table('tbl_petty_cash_transactions')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('balance')->first()->balance;

            } else{
                $fund_balance="0";
                //return "No results";
            }
            $results = DB::table('tbl_staff')->where('staff_id', $staff_id)->get();
            //return $results;
            $client_fname = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('first_name')->first()->first_name;
            $client_lname = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('last_name')->first()->last_name;
            $staff_names=$client_fname." ".$client_lname;
 
            $data1="0";

            $data = [
                'fund_balance' => $fund_balance,
                'staff_id' => $staff_id,
                'staff_names' => $staff_names,
                'data1' => $data1,
                'results' => $results,
                'clients_list' => $staffData,
                //'staffData' => $staffData,
                // Add more data to the array as needed
            ];
            return view ('admins.staffallocationfunds')->with($data);
        }

        $data1="0";

        $data = [
            'data1' => $data1,
            'data2' => $data1,
            'clients_list' => $staffData,
            //'staffData' => $staffData,
            // Add more data to the array as needed
        ];
        return view ('admins.staffallocationfunds')->with($data);
    }


    public function allocateFunds(Request $request)
    {
        // Validate the form data
        $request->validate([
            'balance' => 'required|numeric',
            'amounttopup' => 'required|numeric',
            'staffid' => 'required',
        ]);

        // Get the form input values
        $balance = $request->input('balance');
        $allocated = $request->input('amounttopup');
        $staffId = $request->input('staffid');

        $amountToAllocate=$allocated+$balance;

           // Get the current date and time using Carbon
        $allocationDate = Carbon::now();

        // Perform the allocation insert
        $insertResult = DB::table('tbl_petty_cash_allocation')->insert([
            'staff_id' => $staffId,
            'allocation_date' => $allocationDate,
            'allocated_amount' => $amountToAllocate,
        ]);

        //update transation history
        $insertTransaction = DB::table('tbl_petty_cash_transactions')->insert([
            'staff_id' => $staffId,
            'transaction_date' => $allocationDate,
            'purpose' => "Topup",
            'description' => "Topup",
            'amount' =>  $allocated,
            'balance' => $amountToAllocate,
            'transaction_type' =>  "top-up",
            'created_at' => $allocationDate, 
        ]);


        $client_fname = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staffId)->select('first_name')->first()->first_name;
        $phone = DB::table('tbl_staff')->orderBy('id', 'desc')->where('staff_id', $staffId)->select('phone')->first()->phone;

        $message="Dear $client_fname,\nYour account has been debited with KES $allocated.\nYour New walet balance is KES $amountToAllocate";
        $Notify = $this->SendNotification($phone, $message);
            $logsms=DB::table('tbl_sms_logs')->insert([
                'names' => $client_fname,  // Replace with the recipient's name
                'phone' => $phone, // Replace with the recipient's phone number
                'message' => $message, // Replace with the SMS content
                'sent_at' => now(), // Use the current timestamp
            ]);


            if ($insertResult) {
                // Data was successfully inserted
                return redirect()->back()->with('success', 'Funds allocated successfully');
            } else {
                // Error occurred while inserting data
                return redirect()->back()->with('error', 'Failed to allocate funds. Please try again.');
            }
    }

    public function getAllocationHistory()
    {
                $allocationHistory = DB::table('tbl_petty_cash_allocation')
                ->select(
                    'tbl_petty_cash_allocation.*', // Select all columns from tbl_petty_cash_transactions
                    'tbl_staff.first_name as f_staff_name', // Select the staff name from tbl_staff and alias it as staff_name
                    'tbl_staff.last_name as l_staff_name'
                )
                ->join('tbl_staff', 'tbl_petty_cash_allocation.staff_id', '=', 'tbl_staff.staff_id')
                ->orderBy('tbl_petty_cash_allocation.allocation_date', 'desc')
                ->get();


            $data = [
                'allocationHistory' => $allocationHistory,
                
              
            ];

            return view ('admins.Allocationshistorytable')->with($data);

           
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

    private function SendNotification1(string $phone, string $message)
    {
        // Replace these with your actual credentials
        $apiKey = '4e3f3b621a7b0aabb13f1691729e83f0eff6ab05dbaa6173f46d9cc7f6d56dc5';
        $username = "dennis.mwebia";
        $authorization = base64_encode($username . ':' . $apiKey);

        
        // URL to the API endpoint
        $url = 'https://api.africastalking.com/version1/messaging';

        // Request data
        $data = [
            'username' => $username,
            'to' => $phone,
            'message' => $message,
           //'from' => 'myShortCode', // Change this if needed
        ];

        
        // Set the API key in the headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'apiKey' => $apiKey,
        ];

         // Initialize cURL session
        // Create cURL resource
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded',
                'apiKey: ' . $apiKey
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the cURL request and store the response
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }

            // Close cURL resource
            curl_close($ch);

            // Output the response from the API
            //echo $response;
    }
}
