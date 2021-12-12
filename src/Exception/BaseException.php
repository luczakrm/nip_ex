<?php

namespace App\Exception;

use Exception;

class BaseException extends Exception {

    protected $code;
    protected $message;

    /**
     * Construct the exception
     *
     * @param string|null $message The Exception message to throw
     * @param int|null $code The Exception code
     * @param \Throwable|null $previous The previous exception used for the exception chaining
     */
    public function __construct(?string $message = null, ?int $code = null, \Throwable $previous = null)
    {
        parent::__construct($message ?? $this->message ?? '', $code ?? $this->code ?? 0, $previous);
    }
}