<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::all();

        return view('admins.userstable', ['users' => $users]);
    }

    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
        $user->position = $request->input('position');
        //$user->role = $request->input('role');

        $user->save();

     

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function changePassword(Request $request, User $user)
        {
            $request->validate([
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully.');
        }

        public function registerUser(Request $request)
            {

                //return $request->all();
                // Validate the incoming request data
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'phone' => 'required|string|max:255',
                    'country' => 'required|string|max:255',
                    //'country1' => 'required|exists:countries,country_id', // Assuming your countries table has a 'country_id' column
                    'position' => 'required|string|max:255',
                    'password' => 'required|string|confirmed|min:8', // 'password_confirmation' field must be present and match 'password'
                ]);



                // Create a new user instance
                $user = new User;
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->country = $request->input('country');
                $user->position = $request->input('position');
                $user->role = '2'; // Set the default role as 'user'
                $user->password = Hash::make($request->input('password'));

                // Save the user to the database
                $user->save();

                $fullnames=$request->input('name');
                $email=$request->input('email');
                $username=$request->input('email');
                $pass=$request->input('password');

                Mail::to($email)->send(new RegistrationMail($fullnames, $username, $pass));

                // You can also log in the user if needed
                // auth()->login($user);

                // Redirect to a success page or do something else
                return redirect()->back()->with('success', 'Registration successful!.');
            }
}
