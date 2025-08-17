<?php

namespace GavaBridge\Kra\Http;

class TaxpayerClient extends BaseClient
{
    public function obligations(string $pin): array
    {
        $payload = ['taxPayerPin' => $pin];
        $res = $this->http()->get($this->endpoint('obligations'), $payload);
        return $this->unwrap($res);
    }

    public function liabilities(string $pin, string $obligationId): array
    {
        $payload = ['taxPayerPin' => $pin, 'obligationId' => $obligationId];
        $res = $this->http()->get($this->endpoint('liabilities'), $payload);
        return $this->unwrap($res);
    }
}
