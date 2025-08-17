<?php

namespace GavaConnect\Kra\Http;

class PinClient extends BaseClient
{
    public function validateByPin(string $pin): array
    {
        $payload = ['pin' => $pin];
        $res = $this->http()->post($this->endpoint('pin_validate'), $payload);
        return $this->unwrap($res);
    }
}
