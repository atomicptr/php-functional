<?php

namespace Atomicptr\Functional\Exceptions;

use Atomicptr\Functional\Result;
use Exception;

/**
 * Wraps Result errors into an Exception to be re-integrated with other PHP code
 */
class ResultError extends Exception
{
    public const CODE = 1727082028;

    public function __construct(private Result $result)
    {
        assert($result->hasError(), "tried to throw a Result error despite the associated result not being an error");
        parent::__construct((string)$this, static::CODE);
    }

    public function __toString(): string
    {
        return $this->result::class . ": " . $this->result->errorValue();
    }
}
