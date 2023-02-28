<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BaseException extends Exception
{
    public const MSG_PREFIX = "Datasource Error";

    public function __construct($message = null, $code = 0, Exception $e = null)
    {
        $message = !empty($message) ? static::MSG_PREFIX . ": {$message}" : static::MSG_PREFIX;
        parent::__construct($message, $code, $e);
    }

    /**
     * @param $request
     */
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}