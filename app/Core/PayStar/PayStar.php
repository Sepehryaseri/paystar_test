<?php

namespace App\Core\PayStar;

use App\Core\PayStar\Services\CreateTransactionService;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class PayStar
{
    public function createTransaction(float $amount, string $order_id, string $name): array
    {
        return (new CreateTransactionService())->body($amount, $order_id, $name)->request();
    }
}
