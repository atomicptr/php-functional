<?php

namespace Atomicptr\Functional\Variants\Result;

use Atomicptr\Functional\Exceptions\InvariantViolationException;
use Atomicptr\Functional\Result;
use Stringable;
use Throwable;

/**
 * Represents the success value of a failable result
 * @see Result
 * @template T
 */
final readonly class Ok extends Result
{
    public function __construct(
        private mixed $value
    ) {}

    /**
     * @return T
     */
    public function get(): mixed
    {
        return $this->value;
    }

    public function errorValue(): string|Stringable|Throwable
    {
        throw new InvariantViolationException("Can't get Result error on an Ok value");
    }
}
