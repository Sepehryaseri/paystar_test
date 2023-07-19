<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\QueryException;
use JetBrains\PhpStorm\ArrayShape;

trait Exceptionable
{
    #[ArrayShape(['status' => "int", 'message' => "mixed"])] public function getMessage(Exception $exception, int $statusCode = 400): array
    {
        $message = '';
        if ($exception instanceof QueryException) {
            $message = trans('error.internal');
        } else {
            $message = $exception->getMessage();
        }

        return ['status' => $statusCode, 'message' => $message];
    }
}
