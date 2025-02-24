<?php

namespace Docsecure\Sdk\Exceptions;

class ValidationException extends ApiException
{
    public function __construct(string $message = "Invalid request data.", int $httpCode = 422)
    {
        parent::__construct($message, $httpCode);
    }
}
