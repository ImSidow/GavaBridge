<?php

namespace GavaConnect\Kra\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use GavaConnect\Kra\Support\KraException;

abstract class BaseClient
{
    public function __construct(protected array $config, protected AuthClient $auth) {}

    protected function http(): PendingRequest
    {
        $env = $this->config['env'];
        $base = $this->config['auth'][$env]['api_base'];
        $timeout = $this->config['http']['timeout'];
        $token = $this->auth->token();

        return Http::baseUrl($base)
            ->timeout($timeout)
            ->retry(
                $this->config['http']['retry']['times'],
                $this->config['http']['retry']['sleep_ms']
            )
            ->withToken($token)
            ->acceptJson();
    }

    protected function endpoint(string $key): string
    {
        $path = $this->config['endpoints'][$key] ?? null;
        if (!$path) {
            throw new KraException("Endpoint [$key] is not configured.");
        }
        return $path;
    }

    protected function unwrap($response)
    {
        if ($response->successful()) {
            return $response->json();
        }
        throw new KraException($response->body(), $response->status());
    }
}
