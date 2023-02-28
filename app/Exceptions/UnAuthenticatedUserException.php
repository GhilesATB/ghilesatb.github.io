<?php

namespace App\Exceptions;

class UnAuthenticatedUserException extends BaseException
{
    public const MSG_PREFIX = "Un authenticated user ";
}