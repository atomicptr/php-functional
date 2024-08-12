<?php

namespace Atomicptr\Functional;

use Exception;

/**
 * Wraps Result errors into an Exception to be re-integrated with other PHP code
 */
class ResultError extends Exception
{
    public function __construct(private Result $result)
    {
        assert($result->hasError(), "tried to throw a Result error despite the associated result not being an error");
        parent::__construct((string)$this, 0);
    }

    public function __toString(): string
    {
        return $this->result::class . ": " . $this->result->errorValue();
    }
}
