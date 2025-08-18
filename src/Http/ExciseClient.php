<?php

namespace GavaBridge\Kra\Http;

class ExciseClient extends BaseClient
{
    public function checkByPin(string $pin): array
    {
        $payload = ['PINNo' => $pin];
        $res = $this->get($this->endpoint('excise_license_by_pin'), $payload);
        return $this->unwrap($res);
    }

    public function checkByNumber(string $certificateNumber): array
    {
        $payload = ['ExciseLicenceNo' => $certificateNumber];
        $res = $this->get($this->endpoint('excise_license_by_number'), $payload);
        return $this->unwrap($res);
    }
}
