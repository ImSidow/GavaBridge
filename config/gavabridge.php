<?php

return [
    'env' => env('KRA_ENV', 'sandbox'),

    'auth' => [
        'sandbox' => [
            'token_url' => env('KRA_TOKEN_URL_SANDBOX', 'https://sbx.kra.go.ke/oauth/token'),
            'api_base'  => env('KRA_API_BASE_SANDBOX', 'https://sbx.kra.go.ke'),
        ],
        'production' => [
            'token_url' => env('KRA_TOKEN_URL_PROD', 'https://api.kra.go.ke/oauth/token'),
            'api_base'  => env('KRA_API_BASE_PROD', 'https://api.kra.go.ke'),
        ],
        'key'    => env('KRA_CONSUMER_KEY'),
        'secret' => env('KRA_CONSUMER_SECRET'),
        'scope'  => env('KRA_SCOPE', ''), // if required
    ],

    'endpoints' => [
        'pin_validate'  => env('KRA_PIN_VALIDATE_PATH', '/itax/pin/validate-by-pin'),   // e.g. PIN_Validation_by_PIN
        'tcc_validate'  => env('KRA_TCC_VALIDATE_PATH', '/itax/tcc/validate'),          // KRA-TCC-Validation-Sbx
        'excise_license' => env('KRA_EXCISE_CHECK_PATH', '/dtd/excise-license/check-by-number'),
        'obligations'   => env('KRA_OBLIGATIONS_PATH', '/itax/taxpayer/obligations'),
        'liabilities'   => env('KRA_LIABILITIES_PATH', '/ecitizen/taxpayer/liabilities'),
        'nil_return'    => env('KRA_NIL_RETURN_PATH', '/itax/returns/nil'),

    ],

    'http' => [
        'timeout' => (int) env('KRA_TIMEOUT', 15),
        'retry'   => [
            'times' => 3,
            'sleep_ms' => 200,
        ],
    ],

    'cache' => [
        'store' => env('KRA_CACHE_STORE', null),
        'key'   => 'kra:token',
        'ttl'   => 3500,
    ],
];
