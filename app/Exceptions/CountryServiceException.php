<?php

namespace App\Exceptions;

use Exception;
use Throwable; 

class CountryServiceException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json([
            'errors' => [
                [
                    'message' => $this->getMessage(),
                    'extensions' => [
                        'code' => 'COUNTRY_SERVICE_ERROR',
                        'status' => $this->getCode(),
                    ],
                ],
            ],
        ], $this->getCode() >= 400 ? $this->getCode() : 500);
    }
}