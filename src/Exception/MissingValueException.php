<?php

namespace App\Exception;

class MissingValueException extends BaseException {

    protected $message = 'Missing or empty value';
    protected $code = 1001;

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