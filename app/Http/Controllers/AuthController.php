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

            if ($user && $user->account_status === 'active') {
                // Authentication success
                return response()->json(['statuscode' => '200', 'message' => 'Authentication successful', 'StaffData' => $user]);
            } else {
                // Authentication failed or account is not active
                return response()->json(['statuscode' => '401', 'message' => $user ? 'Account is not active' : 'Authentication failed. Confirm your credentials'], 401);
            }
    }
}
