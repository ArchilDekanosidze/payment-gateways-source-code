<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tco\TwocheckoutFacade;

class TwoCheckoutController extends Controller
{
    public function showFrom()
    {
        return view('gateways.twocheckout-form');
    }

    public function success()
    {
        return 'payment success';
    }

    public function handlePayment(Request $request)
    {
        $config    = [
            'sellerId'      => config('twocheckout.sellerId'),
            'secretKey'     => config('twocheckout.secretKey'),
            'jwtExpireTime' => config('twocheckout.jwtExpireTime'),
            'curlVerifySsl' => config('twocheckout.curlVerifySsl')
        ];

        


        try{
            $tco = new TwocheckoutFacade($config);

            $orderParams = [
                'Country' => 'US',
                'Currency' => 'USD',
                'CustomerIP' => '',
                'ExternalReference' => 'CustOrd101',
                'Language' => 'en',
                'Source' => 'tcolib.local',
                'BillingDetails' => [
                    'Address1' => 'Street 1',
                    'City' => 'Cleveland',
                    'State' => 'Ohio',
                    'CountryCode' => 'US',
                    'Email' => 'testcustomer@2Checkout.com',
                    'FirstName' => 'John',
                    'LastName' => 'Doe',
                    'Zip' => '20034',
                ],
                'Items' => [
                    [
                        'Name' => 'Colored Pencil',
                        'Description' => 'Test description',
                        'Quantity' => 1,
                        'IsDynamic' => true,
                        'Tangible' => false,
                        'PurchaseType' => 'PRODUCT',
                        'Price' => [
                            'Amount' => 40, //value
                            'Type' => 'CUSTOM',
                        ]
                    ]
                ],
                'PaymentDetails' => [
                    'Type' => 'TEST', //'TEST' or 'EES_TOKEN_PAYMENT'
                    'Currency' => 'USD',
                    'CustomerIP' => '91.220.121.21',
                    'PaymentMethod' => [
                        'RecurringEnabled' => false,
                        'HolderNameTime' => 1,
                        'CardNumberTime' => 1,
                        'EesToken' => $request->ess_token,

                    ],
                ],
            ];

            $result = $tco->apiCore()->call( '/orders/', $orderParams, 'POST' );
    
            if(isset($result) && $result['Status'] == 'AUTHRECEIVED'){
                
                return response([
                    'success' => true,
                    'redirect' => route('twocheckout.success')
                ]);
            }else {
                dd($result);
            }

        }catch(\Exception $e){
            dd($e);
        }
       
    }
}
