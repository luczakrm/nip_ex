<?php

namespace App\Exception;

class InvalidValueTypeException extends BaseException {

    protected $message = 'Invalid value type';
    protected $code = 1002;

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