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
                        'phone_number' => 'required|numeric',
                    ]);

                    // Retrieve the input data
                    $staff_id = $request->input('staff_id');
                    $amount = $request->input('amount');
                    $purpose = $request->input('purpose');
                    $phoneNumber = $request->input('phone_number');

                    $WithdrawalLimit = DB::table('tbl_petty_cash_transactions')->orderBy('id', 'desc')->where('staff_id', $staff_id)->select('balance')->first()->balance;
                    
                    if ($amount >= $WithdrawalLimit) {
                        return response()->json([
                            'status_code'=> 401,
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
                    'description' => $purpose,
                    'amount' =>  $amount,
                    'balance' => $newbalance,
                    'transaction_type' =>  "withdrawal",
                    'created_at' => $TransactionDate, 
                ]);





                    // Return a response
                    return response()->json([
                        'status_code'=> 200,
                        'message' => 'Payment processed successfully',
                        'staff_id' => $staff_id,
                        'amount' => $amount,
                        'NewBalance' => $newbalance,
                    ]);
                }
}
