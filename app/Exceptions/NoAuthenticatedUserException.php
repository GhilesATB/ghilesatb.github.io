<?php

namespace App\Exceptions;

class NoAuthenticatedUserException extends BaseException
{
    public const MSG_PREFIX = "No authenticated user ";
}