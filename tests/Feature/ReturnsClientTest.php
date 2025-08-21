<?php

use Illuminate\Support\Facades\Http;
use GavaBridge\Kra\Support\KraManager;

it('files a NIL return', function () {
    $expectingRes = [
        'RESPONSE' => [
            "Status" => 'OK',
            "AckNumber" => 'KRAKBU1456050925',
            /* other pin data params */
        ],
    ];

    $cfg = config('gavabridge');
    Http::fake([
        $cfg['endpoints']['nil_return'] => Http::response($expectingRes, 200),
    ]);

    $payload = ["TAXPAYERDETAILS" => ["TaxpayerPIN" => "A000000000L", "ObligationCode" => "4", "Month" => "04", "Year" => "2000"]];
    $res = app(KraManager::class)->returns()->fileNil($payload);

    expect($res)->toMatchArray([...$expectingRes]);
});
