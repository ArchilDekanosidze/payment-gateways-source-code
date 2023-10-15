<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaystackController extends Controller
{
    public function paystackRedirect()
    {
        return view('gateways.paystack-redirect');
    }

    public function verifyTransaction(Request $request)
    {
        $reference = $request->reference;

        $secret_key = config('paystack.secret_key');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$secret_key
        ])->get("https://api.paystack.co/transaction/verify/$reference");

        $response_body = json_decode($response);

        if($response_body->status == true){
            return 'Payment success';
        }else{
            return 'Payment fail';
        }
        
    }
}
