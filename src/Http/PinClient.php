<?php

namespace GavaBridge\Kra\Http;

class PinClient extends BaseClient
{
    public function validateByPin(string $pin): array
    {
        $payload = ['KRAPIN' => $pin];
        $res = $this->http()->post($this->endpoint('pin_validate_by_pin'), $payload);
        return $this->unwrap($res);
    }

    public function validateByID(string $type, string $id): array
    {
        $payload = ['TaxpayerType' => $type, 'TaxpayerID' => $id];
        $res = $this->http()->post($this->endpoint('pin_validate_by_id'), $payload);
        return $this->unwrap($res);
    }
}
