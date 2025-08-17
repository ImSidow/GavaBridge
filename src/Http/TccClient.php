<?php

namespace GavaBridge\Kra\Http;

class TccClient extends BaseClient
{
    public function validate(string $pin, string $tccNumber): array
    {
        $payload = ['pin' => $pin, 'tcc_number' => $tccNumber];
        $res = $this->http()->post($this->endpoint('tcc_validate'), $payload);
        return $this->unwrap($res);
    }
}
