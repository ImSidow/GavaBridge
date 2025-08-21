<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GavaBridge\Kra\Support\KraManager;
use GavaBridge\Kra\Http\PinClient;

class KraManagerTest extends TestCase
{
    public function testPinClientIsReturned()
    {
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
        $manager = new KraManager($config);
        $client = $manager->pin();
        $this->assertInstanceOf(PinClient::class, $client);
    }
}
