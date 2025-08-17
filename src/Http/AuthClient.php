<?php

namespace GavaConnect\Kra\Http;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthClient
{
    public function __construct(private array $config) {}

    public function token(): string
    {
        $cacheKey = $this->config['cache']['key'] . ':' . $this->config['env'];

        return Cache::store($this->config['cache']['store'])
            ->remember($cacheKey, $this->config['cache']['ttl'], function () {
                $env = $this->config['env'];
                $auth = $this->config['auth'][$env];
                $resp = Http::asForm()
                    ->withBasicAuth($this->config['auth']['key'], $this->config['auth']['secret'])
                    ->post($auth['token_url'], [
                        'grant_type' => 'client_credentials',
                        'scope'      => $this->config['auth']['scope'] ?? '',
                    ]);

                if (!$resp->successful()) {
                    throw new \RuntimeException('KRA token error: ' . $resp->body());
                }
                $data = $resp->json();
                return $data['access_token'] ?? '';
            });
    }
}
