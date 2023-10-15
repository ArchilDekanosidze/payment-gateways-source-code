<?php

return [
    'sellerId'      => env('TWO_CHECKOUT_SELLER_ID'), // REQUIRED
    'secretKey'     => env('TWO_CHECKOUT_SECRET_KEY'), // REQUIRED
    'jwtExpireTime' => env('TWO_CHECKOUT_JWT_EXPIRE_TIME'),
    'curlVerifySsl' => env('TWO_CHECKOUT_CURL_VERIFY_SSL')

];