<?php

namespace Docsecure\Sdk\Exceptions;

class AuthException extends ApiException
{
    public function __construct(string $message = "Authentication failed.", int $httpCode = 401)
    {
        parent::__construct($message, $httpCode);
    }
}
