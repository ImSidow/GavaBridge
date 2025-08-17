<?php

namespace GavaBridge\Kra\Support;

use GavaBridge\Kra\Http\AuthClient;
use GavaBridge\Kra\Http\PinClient;
use GavaBridge\Kra\Http\TccClient;
use GavaBridge\Kra\Http\ExciseClient;
use GavaBridge\Kra\Http\TaxpayerClient;
use GavaBridge\Kra\Http\ReturnsClient;

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
