<?php

namespace App\Traits;

use App\Exceptions\TransactionException;
use Exception;
use Illuminate\Database\QueryException;
use JetBrains\PhpStorm\ArrayShape;

trait Exceptionable
{
    #[ArrayShape(['status' => "int", 'message' => "mixed"])] public function getException(Exception $exception, int $statusCode = 400): array
    {
        if ($exception instanceof QueryException) {
            $message = __('error.internal');
        } elseif ($exception instanceof TransactionException) {
            $message = __('transaction.not_inserted');
        } else {
            $message = $exception->getMessage();
        }

        return ['status' => $statusCode, 'message' => $message];
    }
}
