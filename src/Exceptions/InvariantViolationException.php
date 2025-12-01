<?php

namespace Atomicptr\Functional\Exceptions;

use RuntimeException;
use Throwable;

class InvariantViolationException extends RuntimeException
{
    public const CODE = 1764600921;

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct(
            "Invariant Violation: $message",
            static::CODE,
            $previous,
        );
    }
}
