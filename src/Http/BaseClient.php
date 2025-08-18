<?php

namespace GavaBridge\Kra\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use GavaBridge\Kra\Support\KraException;

abstract class BaseClient
{
    public function __construct(protected array $config, protected AuthClient $auth) {}

    protected function http(): PendingRequest
    {
        $env     = $this->config['env'];
        $base    = $this->config['auth'][$env]['api_base'];
        $timeout = $this->config['http']['timeout'] ?? 15;
        $token   = $this->auth->token();

        return Http::baseUrl($base)
            ->timeout($timeout)
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

    protected function send(callable $fn)
    {
        $response = $fn($this->http());

        if ($this->isTokenExpired($response)) {
            $this->auth->forgetToken();
            $response = $fn($this->rebuildHttpWithFreshToken());
        }

        return $response;
    }

    protected function get(string $endpoint, array $query = [])
    {
        return $this->send(fn(PendingRequest $c) => $c->get($endpoint, $query));
    }

    protected function post(string $endpoint, array $body = [])
    {
        return $this->send(fn(PendingRequest $c) => $c->post($endpoint, $body));
    }

    protected function rebuildHttpWithFreshToken(): PendingRequest
    {
        $this->auth->token(true);
        return $this->http();
    }

    protected function isTokenExpired($response): bool
    {
        $status = $response->status();

        if ($status === 401) {
            $lower = strtolower(json_encode((array)$response->json()));
            return str_contains($lower, 'invalid_token') || str_contains($lower, 'expired') || str_contains($lower, 'invalid access token');
        }

        // Some gateways return 500 with this body:
        // {"fault":{"faultstring":"Access Token expired","detail":{"errorcode":"keymanagement.service.access_token_expired"}}}
        if ($status === 500) {
            $fault = data_get($response->json(), 'fault.faultstring');
            if (is_string($fault) && stripos($fault, 'access token expired') !== false) {
                return true;
            }
        }

        return false;
    }

    protected function unwrap($response)
    {
        if ($response->successful()) {
            return $response->json();
        }
        throw new KraException($response->body(), $response->status());
    }
}
