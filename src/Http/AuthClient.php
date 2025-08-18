<?php

namespace GavaBridge\Kra\Http;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthClient
{
    public function __construct(private array $config) {}

    protected function cacheStore()
    {
        return $this->config['cache']['store'] ?? null;
    }

    protected function cacheKey(): string
    {
        $env = $this->config['env'];
        $base = $this->config['cache']['key'] ?? 'gavabridge:token';
        return $base . ':' . $env;
    }

    public function token(bool $force = false): string
    {
        $store = $this->cacheStore();
        $key   = $this->cacheKey();
        $ttl   = $this->config['cache']['ttl'] ?? 3500;

        // If force is true, always fetch a new token
        if ($force) {
            $res = $this->fetchToken();
            Cache::store($store)->put($key, $res['access_token'], $res['expires_in'] ?? $ttl);
            return $res['access_token'];
        }

        // Check if token is cached
        if (Cache::store($store)->has($key)) {
            return Cache::store($store)->get($key);
        }

        // If not cached, fetch a new token
        $res = $this->fetchToken();
        Cache::store($store)->put($key, $res['access_token'], $res['expires_in'] ?? $ttl);
        return $res['access_token'];
    }

    public function forgetToken(): void
    {
        Cache::store($this->cacheStore())->forget($this->cacheKey());
    }

    protected function fetchToken(): array
    {
        $env  = $this->config['env'];
        $auth = $this->config['auth'][$env] ?? [];

        $resp = Http::asForm()
            ->withBasicAuth($this->config['auth']['key'], $this->config['auth']['secret'])
            ->get($auth['token_url'], [
                'grant_type' => 'client_credentials',
                'scope'      => $this->config['auth']['scope'] ?? '',
            ]);

        if (!$resp->successful()) {
            throw new \RuntimeException('KRA token error: ' . $resp->body());
        }

        return $resp->json();
    }
}
