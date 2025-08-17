<?php

namespace GavaBridge\Kra\Http;

class ExciseClient extends BaseClient
{
    public function checkByNumber(string $certificateNumber): array
    {
        $payload = ['certificate_number' => $certificateNumber];
        $res = $this->http()->get($this->endpoint('excise_license'), $payload);
        return $this->unwrap($res);
    }
}
