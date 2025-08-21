<?php

use Illuminate\Support\Facades\Http;
use GavaBridge\Kra\Support\KraManager;

it('fetches Taxpayer Obligations', function () {
    $expectingRes = [
        "RESULT" => [
            "Status" => 'OK',
            'ObligationsList' => [
                [
                    "obligationId" => '4',
                    "obligationType" => 'NRM',
                    /* other pin data params */
                ]
                /* other pin data params */
            ],
        ]
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['obligations'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->taxpayer()->obligations('A000000000L');
    expect($res)->toMatchArray($expectingRes);
});

it('fetches Taxpayer Liabilities', function () {
    $expectingRes = [
        "RESULT" => [
            "Status" => 'OK',
            "PinNo" => "A00000000L",
            "ObligationId" => "4",
            'ObligationsList' => [
                [
                    "TaxPeriodFrom" => "01-01-2017",
                    "TaxPeriodTo" => "31-12-2017",
                    "PrincipalAmount" => "152647204",
                    "FineAmount" => "0.0",
                    /* other pin data params */
                ]
                /* other pin data params */
            ],
        ]
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['liabilities'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->taxpayer()->liabilities('A000000000L', '4');
    expect($res)->toMatchArray($expectingRes);
});
