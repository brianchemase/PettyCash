<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {

        $data1="";



        $data = [
            'data1' => $data1,
            'data2' => $data1,
            'data3' => $data1,
            'data4' => $data1,
            // Add more data to the array as needed
        ];

        return view ('admins.home')->with($data);
    }

    public function managestaff()
    {



        $data1="";

        $staffData = DB::table('tbl_staff')->get();

        $data = [
            'data1' => $data1,
            'data2' => $data1,
            'data3' => $data1,
            'staffData' => $staffData,
            // Add more data to the array as needed
        ];
        return view ('admins.staffmanagement')->with($data);
    }

    public function registerStaff(Request $request)
    {


        // Validate the input data
                $validatedData = $request->validate([
                    'fname' => 'required|string|max:255',
                    'mname' => 'nullable|string|max:255',
                    'lname' => 'required|string|max:255',
                    'phone' => 'required|string|max:255',
                    'email' => 'required|email|unique:tbl_staff,email',
                    'gender' => 'required|string|max:255',
                    'id_number' => 'required|string|unique:tbl_staff,id_no',
                ]);


                if ($request->hasFile('passport')) {

                    $request->validate([
                        'passport' => 'mimes:png,jpg,jpeg|max:2048' // Only allow .jpg, .bmp and .png file types.
                    ]);
            
                    $finfo = new \finfo(FILEINFO_MIME_TYPE);
                     // Save the file locally in the storage/public/ folder under a new folder named /ppts
                     $request->passport->store('ppts', 'public');
                }

                $staff_id="P".$request->input('id_number');
                $access_pin = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $inserted =  DB::table('tbl_staff')->insert([
                        'first_name' => $request->input('fname'),
                        'middle_name' => $request->input('mname'),
                        'last_name' => $request->input('lname'),
                        'phone' => $request->input('phone'),
                        'email' => $request->input('email'),
                        'gender' => $request->input('gender'),
                        'access_pin' => $access_pin, // Add your logic for generating an access pin
                        'staff_id' => $staff_id,   // Add your logic for generating a staff ID
                        'id_no' => $request->input('id_number'),
                        'account_status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);


                    if ($inserted) {
            
                        return back()->with('success','Your staff data saved successfully!');
                    } else {
                       
                        return back()->with('error','Something went wrong, try again later or contact system admin');
                    }




    }

    public function dashboardforms()
    {
        
        
        return view('admins.forms');
    }

    public function blankpage()
    {
        
        
        return view('admins.blank');
    }

    public function tablepage()
    {
        
        return view('admins.table');
    }
}
