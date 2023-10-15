<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InstamojoController extends Controller
{
    public function payment(Request $request)
    {
        // validation 

        $api_key = config('instamojo.api_key');
        $auth_token = config('instamojo.auth_token');

        $url = config('instamojo.end_point').'payment-requests/';
        // https://test.instamojo.com/api/1.1/payment-requests/

            $response = Http::withHeaders([
                "X-Api-Key" => $api_key,
                "X-Auth-Token" => $auth_token
            ])->post($url, [
                'purpose' => 'Online Payment',
                'amount' => $request->price,
                'phone' => '9916231473',
                'buyer_name' => 'test user',
                'redirect_url' => route('instamojo.callback'),
                'send_email' => true,
                'webhook' => 'http://www.example.com/webhook/',
                'send_sms' => true,
                'email' => 'test@gmail.com',
                'allow_repeated_payments' => false
            ]);
    
            $response_body = json_decode($response);

            if($response_body->success == true){
                return redirect($response_body->payment_request->longurl);
            }else {
                dd($response_body);
            }
    
       

    }


    public function callback(Request $request)
    {
        
        $api_key = config('instamojo.api_key');
        $auth_token = config('instamojo.auth_token');

        $url = config('instamojo.end_point').'payments/'.$request->payment_id;
        // https://test.instamojo.com/api/1.1/payments/

        $response = Http::withHeaders([
            "X-Api-Key" => $api_key,
            "X-Auth-Token" => $auth_token
        ])->get($url);

        if($response->failed()){
            dd($response);
        }else{
            $response_body = json_decode($response);
            
            if($response_body->success == true && $response_body->payment->status == 'Credit'){
                return 'payment success!';
            }
        }
        
    }   
}



