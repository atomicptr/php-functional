<?php

namespace Atomicptr\Functional;

/**
 * Represents the value of an optional value.
 * @see Option
 * @template T
 */
final class Some extends Option
{
    public function __construct(
        private readonly mixed $value,
    ) {}

    public function bind(callable $fn): mixed
    {
        $res = $fn($this->value);
        assert($res instanceof Option);
        return $res;
    }

    public function get(): mixed
    {
        return $this->value;
    }
}
