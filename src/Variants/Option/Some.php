<?php

namespace Atomicptr\Functional\Variants\Option;

use Atomicptr\Functional\Option;

/**
 * Represents the value of an optional value.
 * @see Option
 * @template T
 */
final readonly class Some extends Option
{
    public function __construct(
        private readonly mixed $value,
    ) {}

    public function get(): mixed
    {
        return $this->value;
    }
}
