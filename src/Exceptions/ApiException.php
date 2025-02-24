<?php

namespace Docsecure\Sdk\Exceptions;

use Exception;

class ApiException extends Exception
{
    private $httpCode;

    public function __construct(string $message, int $httpCode = 0, Exception $previous = null)
    {
        parent::__construct($message, $httpCode, $previous);
        $this->httpCode = $httpCode;
    }

    /**
     * Get the HTTP status code associated with the exception.
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }
}

