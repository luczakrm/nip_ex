<?php

namespace App\Exception;

class InvalidValueException extends BaseException {

    protected $message = 'Invalid value';
    protected $code = 1004;

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