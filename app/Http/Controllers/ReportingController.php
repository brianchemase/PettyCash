<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class ReportingController extends Controller
{
    //
    public function transactionsReport()
    {
        $results = DB::table('tbl_petty_cash_transactions')
            ->join('tbl_staff', 'tbl_petty_cash_transactions.staff_id', '=', 'tbl_staff.staff_id')
            ->select('tbl_staff.first_name', 'tbl_staff.middle_name', 'tbl_staff.last_name', 'tbl_petty_cash_transactions.*')
            ->get();

           // return $results;

            $data = [
                'title' => 'Total Transactions Conducted',
                'results' =>  $results,
                'date' => date('m/d/Y')
            ];
              
            $pdf = PDF::loadView('report.Trans', $data);
        
            $pdf->setPaper('L', 'landscape');
            return $pdf->stream("TransactionReport.pdf");



    }

    public function StaffTransactionReport(Request $request, $staffId)
    {


        //$staffId = 'P32676666'; // Replace with the staff_id you want to filter by

        $results = DB::table('tbl_petty_cash_transactions')
            ->join('tbl_staff', 'tbl_petty_cash_transactions.staff_id', '=', 'tbl_staff.staff_id')
            ->select('tbl_staff.first_name', 'tbl_staff.middle_name', 'tbl_staff.last_name', 'tbl_petty_cash_transactions.*')
            ->where('tbl_petty_cash_transactions.staff_id', $staffId)
            ->get();

            //return $results;

            $data = [
                'title' => 'Staff Total Transactions Conducted',
                'results' =>  $results,
                'date' => date('m/d/Y')
            ];
              
            $pdf = PDF::loadView('report.staffTrans', $data);
        
            $pdf->setPaper('L', 'landscape');
            return $pdf->stream("TransactionReport.pdf");

    }
}
