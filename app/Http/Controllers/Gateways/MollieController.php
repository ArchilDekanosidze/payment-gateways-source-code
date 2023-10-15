<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function payment(Request $request)
    {

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" =>  number_format($request->price,2,'.','')// You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "redirectUrl" => route('mollie.success'),
            // "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);

       session()->put('mollie_id', $payment->id);
    
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
        
    }

    public function success(Request $request)
    {
        $paymentId = session()->get('mollie_id');
        $payment = Mollie::api()->payments->get($paymentId);
    
        if ($payment->isPaid())
        {
            return 'payment success';
        }else {
            return 'Payment not completed';
        }
    }

}
