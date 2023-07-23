<?php

namespace App\Core\PayStar\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static createTransaction(mixed $amount, string $orderId, mixed $username)
 * @method static verifyTransaction(string $refNumber, float $amount, string $sign)
 */
class Paystar extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'paystar';
    }
}
