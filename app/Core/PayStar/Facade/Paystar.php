<?php

namespace App\Core\PayStar\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static createTransaction(mixed $amount, string $orderId, mixed $username)
 */
class Paystar extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'paystar';
    }
}
