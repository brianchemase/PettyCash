<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {

        $data1="";
        $AllocatedPettyCash = DB::table('tbl_petty_cash_allocation')->sum('allocated_amount');

        $TotalWithdrawn = DB::table('tbl_petty_cash_transactions')
        ->where('purpose', '!=', 'topup')
        ->sum('amount');


        $paybillno="2839102";
        $paybillBalance="10000";
        $totalDisbusments="256370";
       // $AllocatedPettyCash="175000";
        //$TotalWithdrawn="25604758";

         // Fetch transaction data for each month of the year
        $transactionData = DB::table('tbl_petty_cash_transactions')
        ->select(DB::raw('MONTH(transaction_date) as month'), DB::raw('SUM(amount) as total_amount'))
        ->where('transaction_type', '!=', 'top-up') // Add this condition
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Create an array to store monthly data
        $monthlyData = [];

        // Initialize the monthly data array with zeros for all months
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = 0;
        }

        // Populate the monthly data with transaction data
        foreach ($transactionData as $data) {
            $monthlyData[$data->month] = $data->total_amount;
        }

        $data = [
            'paybillno' => $paybillno,
            'paybillBalance' => $paybillBalance,
            'totalDisbusments' => $totalDisbusments,
            'AllocatedPettyCash' => $AllocatedPettyCash,
            'TotalWithdrawn' => $TotalWithdrawn,
            'monthlyData' => $monthlyData,
            'data4' => $data1,
            'data4' => $data1,
            'data4' => $data1,
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

              //return $request->all();

                if ($request->hasFile('ppt')) {

                    $request->validate([
                        'ppt' => 'mimes:png,jpg,jpeg|max:2048' // Only allow .jpg, .bmp and .png file types.
                    ]);
            
                    $finfo = new \finfo(FILEINFO_MIME_TYPE);
                     // Save the file locally in the storage/public/ folder under a new folder named /ppts
                     $request->ppt->store('ppt', 'public');
                }

                $staff_id="P".$request->input('id_number');
                $access_pin = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $fname=$request->input('fname');
                $phone=$request->input('phone');
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
                        'ppt_photo'=>$request->ppt->hashName(),
                        'account_status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);


                    if ($inserted) {
                        $message="Dear $fname,\nYour username is $staff_id and your access code is:$access_pin.\nDont share your access key with anyone.\n#staySecureWithPettyQash";
                        $Notify = $this->SendNotification($phone, $message);
            
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

    public function SendNotification1($phone, $message)
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

    private function SendNotification(string $phone, string $message)
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
