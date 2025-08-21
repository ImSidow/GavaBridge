<?php

use Illuminate\Support\Facades\Http;
use GavaBridge\Kra\Support\KraManager;

it('auto-refreshes token when API says Access Token expired', function () {
    Http::fakeSequence()
        ->push(['access_token' => 'old_token'], 200)
        ->push([
            'fault' => [
                'faultstring' => 'Access Token expired',
                'detail' => ['errorcode' => 'keymanagement.service.access_token_expired'],
            ],
        ], 500)
        ->push(['access_token' => 'new_token'], 200)
        ->push(['ok' => true, 'pin' => 'A000000010'], 200);

    Http::fake([
        'https://sbx.example/v1/token/generate' => Http::sequence()
            ->push(['access_token' => 'old_token'], 200)
            ->push(['access_token' => 'new_token'], 200),

        'https://sbx.example/checker/v1/pinbypin' => Http::sequence()
            ->push([
                'fault' => [
                    'faultstring' => 'Access Token expired',
                    'detail' => ['errorcode' => 'keymanagement.service.access_token_expired'],
                ],
            ], 500)
            ->push(['ok' => true, 'pin' => 'A000000010'], 200),
    ]);

    $res = app(KraManager::class)->pin()->validateByPin('A000000010');
    expect($res)->toMatchArray(['ok' => true, 'pin' => 'A000000010']);
});
