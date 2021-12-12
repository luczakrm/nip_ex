<?php

namespace App\Exception;

class InvalidValueLengthException extends BaseException {

    protected $message = 'Invalid value length';
    protected $code = 1000;

    /**
     * Construct the exception
     *
     * @param \Throwable|null $previous The previous exception used for the exception chaining
     */
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct($this->message, $this->code, $previous);
    }
}