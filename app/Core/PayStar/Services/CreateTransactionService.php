<?php

namespace App\Core\PayStar\Services;

use Illuminate\Support\Facades\Http;

class CreateTransactionService extends Service
{
    public function body(float $amount, string $order_id, string $name): static
    {
        $this->body = [
            'amount' => $amount,
            'order_id' => $order_id,
            'callback' => config('app.callback_url'),
            'name' => $name
        ];
        return $this;
    }

    public function request(): array
    {
        $response = $this->request->post($this->baseUrl . '/create', $this->body);
        return $this->response($response);
    }
}
