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

    Http::fake(['https://sbx.example/checker/v1/pinbypin' => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->pin()->validateByPin('A123456789Z');
    expect($res)->toMatchArray($expectingRes);
});

it('validates PIN by ID', function () {
    $expectingRes = [
        "TaxpayerPIN" => "A000000000I",
        "TaxpayerName" => "YAMAS12 TEST OMINI01"
        /* other response param */
    ];

    Http::fake(['https://sbx.example/checker/v1/pin' => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->pin()->validateByID('KE', 'A000000000I');
    expect($res)->toMatchArray($expectingRes);
});
