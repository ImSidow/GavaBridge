<?php

namespace GavaBridge\Kra\Http;

class TccClient extends BaseClient
{
    public function validate(string $pin, string $tccNumber): array
    {
        $payload = ['kraPIN' => $pin, 'tccNumber' => $tccNumber];
        $res = $this->post($this->endpoint('tcc_validate'), $payload);
        return $this->unwrap($res);
    }
}
