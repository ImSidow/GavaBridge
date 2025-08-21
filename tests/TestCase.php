<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use GavaBridge\Kra\Providers\KraServiceProvider;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        // Prevent hitting real HTTP
        Http::preventStrayRequests();

        // Global fakes
        Http::fake([
            'https://sbx.example/v1/token/generate*' => Http::response(["access_token" => "spIHbaAHDeBAfVfgA6pkSCPrgAvV", "expires_in" => "3599"], 200),
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [KraServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        // Minimal config your package expects
        $app['config']->set('gavabridge', [
            'env' => 'sandbox',
            'auth' => [
                'sandbox' => [
                    'token_url' => 'https://sbx.example/v1/token/generate',
                    'api_base'  => 'https://sbx.example',
                ],
                'key'    => 'dummy',
                'secret' => 'dummy',
            ],

            'endpoints' => [
                'pin_validate_by_pin'  =>  '/checker/v1/pinbypin',
                'pin_validate_by_id'  => '/checker/v1/pin',
                'tcc_validate'  => '/v1/kra-tcc/validate',
                'excise_license_by_pin' => '/checker/v1/ExciseLicenseByPin',
                'excise_license_by_number' => '/checker/v1/ExciseLicenseByNum',
                'obligations'   => '/dtd/checker/v1/obligation',
                'liabilities'   => '/dtd/checker/v1/liabilities',
                'nil_return'    => '/dtd/return/v1/nil',
            ],

            'http' => [
                'timeout' => 15,
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
        ]);
    }
}
