<?php

namespace Atomicptr\Functional;

/**
 * Represents the non existance of a value.
 * @see Option
 */
final class None extends Option
{
    public function bind(callable $fn): mixed
    {
        return $this;
    }

    public function get(): mixed
    {
        assert(false, "Can't get value from None type, did you forget to check the value?");
        return null;
    }
}
