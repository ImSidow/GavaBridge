<?php

namespace GavaConnect\Kra\Http;

class ReturnsClient extends BaseClient
{
    public function fileNil(array $payload): array
    {
        // payload shape depends on API spec on your portal app page
        $res = $this->http()->post($this->endpoint('nil_return'), $payload);
        return $this->unwrap($res);
    }
}
