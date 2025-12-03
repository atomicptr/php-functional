<?php

namespace Atomicptr\Functional\Variants\Result;

use Atomicptr\Functional\Exceptions\InvariantViolationException;
use Atomicptr\Functional\Result;
use Stringable;
use Throwable;

/**
 * Represents the error value of a failable result
 * @see Result
 */
final readonly class Error extends Result
{
    public function __construct(
        private Stringable|Throwable|string $error
    ) {}

    /**
     * Can't get value from Error type, did you forget to check the value?
     * @return never
     * @throws InvariantViolationException
     */
    public function get(): mixed
    {
        throw new InvariantViolationException("Can't get Result on an Error value");
    }

    public function errorValue(): string|Stringable|Throwable
    {
        return $this->error;
    }
}
