<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

   // return $transactionHistory;

    $data = [
        'transactionHistory' => $transactionHistory,
        
        // Add more data to the array as needed
    ];

    return view ('admins.Transationshistorytable')->with($data);

    //Transationshistorytable.blade
}
}
