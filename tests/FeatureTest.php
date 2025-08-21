<?php
use GavaBridge\Kra\Support\KraManager;
use GavaBridge\Kra\Http\PinClient;
use GavaBridge\Kra\Http\TccClient;
use GavaBridge\Kra\Http\ExciseClient;
use GavaBridge\Kra\Http\TaxpayerClient;
use GavaBridge\Kra\Http\ReturnsClient;

describe('GavaBridge Features', function () {
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
            'pin_validate_by_id' => '/checker/v1/pin',
            'tcc_validate' => '/v1/kra-tcc/validate',
            'excise_license_by_pin' => '/checker/v1/ExciseLicenseByPin',
            'excise_license_by_number' => '/checker/v1/ExciseLicenseByNum',
            'obligations' => '/dtd/checker/v1/obligation',
            'liabilities' => '/dtd/checker/v1/liabilities',
            'nil_return' => '/dtd/return/v1/nil',
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
    $manager = new KraManager($config);

    it('returns PinClient from KraManager', function () use ($manager) {
        expect($manager->pin())->toBeInstanceOf(PinClient::class);
    });

    it('returns TccClient from KraManager', function () use ($manager) {
        expect($manager->tcc())->toBeInstanceOf(TccClient::class);
    });

    it('returns ExciseClient from KraManager', function () use ($manager) {
        expect($manager->excise())->toBeInstanceOf(ExciseClient::class);
    });

    it('returns TaxpayerClient from KraManager', function () use ($manager) {
        expect($manager->taxpayer())->toBeInstanceOf(TaxpayerClient::class);
    });

    it('returns ReturnsClient from KraManager', function () use ($manager) {
        expect($manager->returns())->toBeInstanceOf(ReturnsClient::class);
    });
});
