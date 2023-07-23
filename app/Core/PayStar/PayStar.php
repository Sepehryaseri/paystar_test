<?php

namespace App\Core\PayStar;

use App\Core\PayStar\Services\CreateTransactionService;
use App\Core\PayStar\Services\VerifyTransactionService;

class PayStar
{
    public function createTransaction(float $amount, string $order_id, string $name): array
    {
        return (new CreateTransactionService())->body($amount, $order_id, $name)->request();
    }

    public function verifyTransaction(string $refNumber, float $amount, string $sign): array
    {
        return (new VerifyTransactionService())->body($refNumber, $amount, $sign)->request();
    }
}
