<?php
describe('PinClient', function () {
    it('validates by pin returns array', function () {
        $config = [
            'env' => 'sandbox',
            'auth' => [
                'sandbox' => [
                    'token_url' => 'https://sbx.kra.go.ke/v1/token/generate',
                    'api_base' => 'https://sbx.kra.go.ke',
                ],
                'key' => 'dummy',
                'secret' => 'dummy',
                'scope' => '',
            ],
            'endpoints' => [
                'pin_validate_by_pin' => '/checker/v1/pinbypin',
            ],
            'http' => [
                'timeout' => 15,
            ],
            'cache' => [
                'store' => null,
                'key' => 'kra:token',
                'ttl' => 3500,
            ],
        ];
        $auth = new \GavaBridge\Kra\Http\AuthClient($config);
        $client = new \GavaBridge\Kra\Http\PinClient($config, $auth);
        \Pest\expect($client)->toBeInstanceOf(\GavaBridge\Kra\Http\PinClient::class);
    });
});
