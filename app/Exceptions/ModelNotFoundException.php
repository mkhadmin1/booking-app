<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\ResolverNotFoundException;

class ModelNotFoundException extends Exception
{
 public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
 {
     parent::__construct($message, $code, $previous);
 }

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 404);
    }
}
