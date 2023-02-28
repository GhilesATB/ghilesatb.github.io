<?php

namespace App\Exceptions;

class UnAuthenticatedUserException extends BaseException
{
    public const MSG_PREFIX = "UnAuthenticated user ";
}