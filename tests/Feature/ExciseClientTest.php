<?php

use Illuminate\Support\Facades\Http;
use GavaBridge\Kra\Support\KraManager;

it('validates Excise License Checker By Certificate Number', function () {
    $expectingRes = [
        "RESPONSE" => [
            'ExciseLicenseDATA' => [
                "Status" => 'Approved',
                "PINNo" => 'P0516217567A',
                /* other pin data params */
            ],
            'RESULT' => [
                "Status" => 'OK',
                /* other pin data params */
            ],
        ]
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['excise_license_by_number'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->excise()->checkByNumber('KRAHQS0019742020');
    expect($res)->toMatchArray($expectingRes);
});

it('validates Excise License Checker By Pin', function () {
    $expectingRes = [
        "RESPONSE" => [
            'PIN_Details' => [
                "PINNo" => 'P051621738A',
                /* other pin data params */
            ],
            'ExciseLicenseDATA' => [
                [
                    "Status" => 'Approved',
                    "ExciseLicenceNo" => 'KRAHQS0019742020',
                    /* other pin data params */
                ]
            ],
            'RESULT' => [
                "Status" => 'OK',
                /* other pin data params */
            ],
        ]
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['excise_license_by_pin'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->excise()->checkByPin('P075136128A');
    expect($res)->toMatchArray($expectingRes);
});
