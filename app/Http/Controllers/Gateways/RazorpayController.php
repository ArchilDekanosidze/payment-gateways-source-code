<?php

namespace App\Http\Controllers\Gatewas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {   
       $api = new Api(config('razorpay.key'), config('razorpay.secret'));

       $payment = $api->payment->fetch($request->razorpay_payment_id);

       if($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')){
            try {
               $response = $api->payment->fetch($request->razorpay_payment_id)
                            ->capture(['amount' => $payment['amount']]);

            }catch(\Exception $e){
                return $e->getMessage();
            }
       }

       if($response['status'] == 'captured'){
            return 'Payment Success!';
       }
    }
}
