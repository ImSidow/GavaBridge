<?php

use Illuminate\Support\Facades\Http;
use GavaBridge\Kra\Support\KraManager;

it('validates Tax Compliance Certificate', function () {
    $expectingRes = [
        /* other response param */
        'Status' => "OK",
        'TCCData' => [
            "KRAPIN" => 'P051411025H',
            /* other pin data params */
        ],
    ];

    $cfg = config('gavabridge');
    Http::fake([$cfg['endpoints']['tcc_validate'] => Http::response($expectingRes, 200)]);

    $res = app(KraManager::class)->tcc()->validate('A12345678', 'KRAEON1294973222');
    expect($res)->toMatchArray($expectingRes);
});
