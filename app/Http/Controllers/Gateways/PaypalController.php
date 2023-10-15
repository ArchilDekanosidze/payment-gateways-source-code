<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();


        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);

        // dd($response);
        
        if(isset($response['id']) && $response['id'] != null){
            
            foreach($response['links'] as $link){
               
                if($link['rel'] === 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal.cancel');
        }
        
            
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return 'Paid Successfully!';
        }

        return redirect()->route('paypal.cancel');
        
    }

    public function cancel()
    {
        return 'Paymnet faild'; 
    }
}
