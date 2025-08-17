<?php

namespace GavaConnect\Kra\Support;

use GavaConnect\Kra\Http\AuthClient;
use GavaConnect\Kra\Http\PinClient;
use GavaConnect\Kra\Http\TccClient;
use GavaConnect\Kra\Http\ExciseClient;
use GavaConnect\Kra\Http\TaxpayerClient;
use GavaConnect\Kra\Http\ReturnsClient;

class KraManager
{
    public function __construct(private array $config) {}

    protected function auth(): AuthClient
    {
        return new AuthClient($this->config);
    }

    public function pin(): PinClient
    {
        return new PinClient($this->config, $this->auth());
    }

    public function tcc(): TccClient
    {
        return new TccClient($this->config, $this->auth());
    }

    public function excise(): ExciseClient
    {
        return new ExciseClient($this->config, $this->auth());
    }

    public function taxpayer(): TaxpayerClient
    {
        return new TaxpayerClient($this->config, $this->auth());
    }

    public function returns(): ReturnsClient
    {
        return new ReturnsClient($this->config, $this->auth());
    }
}
