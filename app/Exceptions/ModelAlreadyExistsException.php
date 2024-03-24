<?php

namespace App\Exceptions;

use Exception;

class ModelAlreadyExistsException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 422);
    }
}
