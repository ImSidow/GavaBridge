<?php

return [
    'env' => env('GAVABRIDGE_ENV', 'sandbox'), // sandbox|production

    'auth' => [
        'sandbox' => [
            'token_url' => env('GAVABRIDGE_TOKEN_URL_SANDBOX', ''),
            'api_base'  => env('GAVABRIDGE_API_BASE_SANDBOX', ''),
        ],
        'production' => [
            'token_url' => env('GAVABRIDGE_TOKEN_URL_PROD', ''),
            'api_base'  => env('GAVABRIDGE_API_BASE_PROD', ''),
        ],
        'key'    => env('GAVABRIDGE_KEY'),
        'secret' => env('GAVABRIDGE_SECRET'),
        'scope'  => env('GAVABRIDGE_SCOPE', ''), // if portal requires
    ],

    'endpoints' => [
        'pin_validate'    => env('GAVABRIDGE_PIN_VALIDATE', ''),
        'tcc_validate'    => env('GAVABRIDGE_TCC_VALIDATE', ''),
        'excise_license'  => env('GAVABRIDGE_EXCISE_LICENSE', ''),
        'obligations'     => env('GAVABRIDGE_OBLIGATIONS', ''),
        'liabilities'     => env('GAVABRIDGE_LIABILITIES', ''),
        'nil_return'      => env('GAVABRIDGE_NIL_RETURN', ''),
    ],

    'http' => [
        'timeout' => (int) env('GAVABRIDGE_TIMEOUT', 15),
        'retry'   => [
            'times'    => 3,
            'sleep_ms' => 200,
        ],
    ],

    'cache' => [
        'store' => env('GAVABRIDGE_CACHE_STORE', null), // null = default
        'key'   => 'gavabridge:token',
        'ttl'   => 3500,
    ],
];
