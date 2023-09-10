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
                return response()->json(['statuscode' => '200', 'message' => 'Authentication successful', 'StaffData' => $filteredUserData]);
            } else {
                // Authentication failed or account is not active
                return response()->json(['statuscode' => '401', 'message' => $user ? 'Account is not active' : 'Authentication failed. Confirm your credentials'], 401);
            }
    }
}
