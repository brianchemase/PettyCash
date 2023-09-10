<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionPurposeController extends Controller
{
    //


    public function create()
    {

        $transactionPurposes = DB::table('tbl_transaction_purpose')->get();

        $data = [
            
            'transactionPurposes' => $transactionPurposes,
            // Add more data to the array as needed
        ];

       

        return view('admins.transactionpurpose')->with($data);
    }

    public function RegisterPurpose(Request $request)
    {
        // Validate the form data
        $request->validate([
            'purpose' => 'required|string|max:255',
        ]);
        try {
        // Insert the transaction purpose into the database using DB Facade
        DB::table('tbl_transaction_purpose')->insert([
            'purpose' => $request->input('purpose'),
            'status' => 'active', // You can set the default status as needed
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         // If the insertion was successful, redirect with a success message
         return back()->with('success', 'Transaction purpose registered successfully');
        } catch (\Exception $e) {
            // If an exception occurs (e.g., a database error), handle the error
            return back()->with('error', 'An error occurred while registering the transaction purpose.');
        }
        
    }

    public function transactionsRegistered()
    {
        $transactionPurposes = DB::table('tbl_transaction_purpose')
        ->where('status', 'active')
        ->get();
    
        if ($transactionPurposes){

            // return response()->json($transactionPurposes);
        return response()->json(
            ['statuscode' => '200', 
            'message' => 'Authentication successful', 
            'transactions' => $transactionPurposes
            ]);

        }
        else {
            return response()->json(
                ['statuscode' => '404', 
                'message' => 'An Error has happened'
                ]);

        }
       
    }
}
