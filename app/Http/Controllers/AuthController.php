<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'staff_id' => 'required|string',
            'access_pin' => 'required|string',
        ]);

        // Check if the user exists in the tbl_staff table
        $user = DB::table('tbl_staff')
            ->where('staff_id', $request->input('staff_id'))
            ->where('access_pin', $request->input('access_pin'))
            ->first();

        $fullImage="https://pettyqash.hilsan.co.ke/storage/ppt/".$user->ppt_photo;

        // Add the 'full_image' key to the $user object
        $user->full_image = $fullImage;

            if ($user && $user->account_status === 'active') {

                $filteredUserData = [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'middle_name' => $user->middle_name,
                    'last_name' => $user->last_name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'staff_id' => $user->staff_id,
                    'id_no' => $user->id_no,
                    'account_status' => $user->account_status,
                    'full_image' => $fullImage,
                ];
                // Authentication success
                return response()->json(['status_code' => '200', 'message' => 'Authentication successful', 'StaffData' => $filteredUserData]);
            } else {
                // Authentication failed or account is not active
                return response()->json(['status_code' => '401', 'message' => $user ? 'Account is not active' : 'Authentication failed. Confirm your credentials'], 401);
            }
    }

    public function DashboardLogin()
    {



        return view('auth.login');
    }

    public function checkadmin(Request $request)
    {

        //Validate requests
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:5|max:12'
       ]);

       //$userInfo = Admin::where('email','=', $request->email)->first();
      // $userInfo = AdminsData::where('email','=', $request->email)->first();
       $userInfo = DB::table('users')
        ->where('email', '=', $request->email)
        ->first();

       if(!$userInfo){
           return back()->with('fail','We do not recognize your email. Contact Admin for Support');
            }else
        {
           //check password
               $hashedpassword=hash("sha256", $request->password);
               //if($hashedpassword == $userInfo->password){
                if($request->password == $userInfo->password){
                   $request->session()->put('AdminLoggedUser', $userInfo->id);

            //        $logdata=AdminsData::where('id','=', session('AdminLoggedUser'))->first();
            //        $fname=$logdata->firstname;
            //        $lname=$logdata->lastname;
            //        $usernames=$fname.' '.$lname;
            //        $station='ADMIN';
            //        $remarks="has logged in the laravel system at ";
            //        $mda="ADMIN"; 

                        // if (!empty($_SERVER["HTTP_CLIENT_IP"]))
                        //    {
                        //     $ip = $_SERVER["HTTP_CLIENT_IP"];
                        //    }
                        //    elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
                        //    {
                        //     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                        //    }
                        //    else
                        //    {
                        //     $ip = $_SERVER["REMOTE_ADDR"];
                        //    } 
               
            //    $logs= new HistoryLog;
            //    $logs->staff_id=$usernames; 
            //    $logs->station= $station;
            //    $logs->MDA=$mda;
            //    $logs->action= $remarks;
            //    $logs->date=$date = date("Y-m-d H:i:s");
            //    $logs->ip=$ip;
            //    $save = $logs->save();

              // return redirect('admin/dashboard');
               return redirect()->route('admindash');

            
        }else{
            return back()->with('fail','Incorrect password');
        }
        }
    }

        //https://www.youtube.com/watch?v=T9q1uT2BEZI
                public function adminlogout ()
                {

                    if(session()->has('AdminLoggedUser')){
                        session()->pull('AdminLoggedUser');
                        //return redirect('/admin-login');
                        return redirect()->route('AuthLogPage');

                    }

                    
                }
}
