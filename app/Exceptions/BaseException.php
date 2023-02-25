<?php

namespace App\Exceptions;
use Exception;

class BaseException extends Exception
{
    public const MSG_PREFIX = "Datasource Error";

    public function __construct($message = null, $code = 0, Exception $e = null)
    {
        $message = !empty($message) ? static::MSG_PREFIX . ": {$message}" : static::MSG_PREFIX;
        parent::__construct($message, $code, $e);
    }
}
