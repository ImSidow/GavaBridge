<?php

use Illuminate\Support\Facades\Http;
use GavaBridge\Kra\Support\KraManager;

it('validates PIN by pin', function () {
    $expectingRes = [
        /* other response param */
        'Status' => "OK",
        'PINDATA' => [
            "KRAPIN" => 'A123456789Z',
            /* other pin data params */
        ],
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['pin_validate_by_pin'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->pin()->validateByPin('A123456789Z');
    expect($res)->toMatchArray($expectingRes);
});

it('validates PIN by ID', function () {
    $expectingRes = [
        "TaxpayerPIN" => "A000000000I",
        "TaxpayerName" => "YAMAS12 TEST OMINI01"
        /* other response param */
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['pin_validate_by_id'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->pin()->validateByID('KE', 'A000000000I');
    expect($res)->toMatchArray([...$expectingRes]);
});
