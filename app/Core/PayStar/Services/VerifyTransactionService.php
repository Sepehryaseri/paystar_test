<?php

namespace App\Core\PayStar\Services;

class VerifyTransactionService extends Service
{
    public function body(string $refNumber, float $amount, string $sign): static
    {
        $this->body = [
            'ref_num' => $refNumber,
            'amount' => $amount,
            'sign' => $sign,
        ];
        return $this;
    }

    public function request(): array
    {
        $response = $this->request->post($this->baseUrl . '/verify', $this->body);
        return $this->response($response);
    }
}
