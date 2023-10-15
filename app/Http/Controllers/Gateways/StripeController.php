<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $response = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => 'gimme money!!!!',
                        ],
                        'unit_amount'  => $request->price * 100, // $40 = 4000
                    ],
                    'quantity'   => 1,
                ],
            ],
            
            'mode'        => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url'  => route('stripe.cancel'),
        ]);

        return redirect()->away($response->url);
    }

    public function success()
    {
        return 'Yay, It Works !!!!';
    }

    public function cancel()
    {
        return 'Payment cancel!';
    }
}
