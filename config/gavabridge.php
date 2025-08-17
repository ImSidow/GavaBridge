<?php


return [
    'env' => env('KRA_ENV', 'sandbox'),

    'auth' => [
        'sandbox' => [
            'token_url' => env('KRA_TOKEN_URL_SANDBOX', 'https://sbx.kra.go.ke/v1/token/generate'),
            'api_base'  => env('KRA_API_BASE_SANDBOX', 'https://sbx.kra.go.ke'),
        ],
        'production' => [
            'token_url' => env('KRA_TOKEN_URL_PROD', 'https://api.kra.go.ke/v1/token/generate'),
            'api_base'  => env('KRA_API_BASE_PROD', 'https://api.kra.go.ke'),
        ],
        'key'    => env('KRA_CONSUMER_KEY'),
        'secret' => env('KRA_CONSUMER_SECRET'),
        'scope'  => env('KRA_SCOPE', ''), // if required
    ],

    'endpoints' => [
        'pin_validate_by_pin'  => env('KRA_PIN_VALIDATE_BY_PIN_PATH', '/checker/v1/pinbypin'),
        'pin_validate_by_id'  => env('KRA_PIN_VALIDATE_BY_ID_PATH', '/checker/v1/pin'),
        'tcc_validate'  => env('KRA_TCC_VALIDATE_PATH', '/v1/kra-tcc/validate'),
        'excise_license_by_pin' => env('KRA_EXCISE_CHECK_BY_PIN_PATH', '/checker/v1/ExciseLicenseByPin'),
        'excise_license_by_number' => env('KRA_EXCISE_CHECK_BY_NUM_PATH', '/checker/v1/ExciseLicenseByNum'),
        'obligations'   => env('KRA_OBLIGATIONS_PATH', '/dtd/checker/v1/obligation'),
        'liabilities'   => env('KRA_LIABILITIES_PATH', '/dtd/checker/v1/liabilities'),
        'nil_return'    => env('KRA_NIL_RETURN_PATH', '/dtd/return/v1/nil'),
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
