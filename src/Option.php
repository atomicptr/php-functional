<?php

namespace Atomicptr\Functional;

use Atomicptr\Functional\Exceptions\InvariantViolationException;
use Atomicptr\Functional\Variants\Option\None;
use Atomicptr\Functional\Variants\Option\Some;

/**
 * Represents an optional value: every Option is either Some and contains a value, or None, and does not.
 * This type is used in cases where a value may or may not be present.
 *
 * @template T
 */
abstract readonly class Option
{
    /**
     * Creates a Some variant of Option containing the given value.
     *
     * @param T $value The value to wrap in Some.
     * @return Some<T> An Option containing the value.
     */
    public static function some(mixed $value): Some
    {
        return new Some($value);
    }

    /**
     * Creates a None variant of Option, representing the absence of a value.
     *
     * @return None An Option representing no value.
     */
    public static function none(): None
    {
        return new None();
    }

    /**
     * Checks if this Option is a Some variant.
     *
     * @return bool True if this Option is Some, false otherwise.
     */
    public function isSome(): bool
    {
        return $this instanceof Some;
    }

    /**
     * Checks if this Option is a None variant.
     *
     * @return bool True if this Option is None, false otherwise.
     */
    public function isNone(): bool
    {
        return $this instanceof None;
    }

    /**
     * Returns the contained value if this Option is Some.
     * Throws an assertion error if this Option is None.
     *
     * @return T The contained value.
     * @throws InvariantViolationException If this Option is None.
     */
    public abstract function get(): mixed;

    /**
     * Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.
     *
     * @template U
     * @param callable(T): (U|Option<U>) $fn
     * @return Option<U>
     */
    public function map(callable $fn): Option
    {
        if ($this->isNone()) {
            return $this;
        }

        $res = $fn($this->get());
        if ($res instanceof Option) {
            return $res;
        }

        return static::some($res);
    }

    /**
     * Returns value of object if present, otherwise returns $value (executes it if its callable)
     *
     * @template U
     * @param U|callable(): U $value
     * @return U
     */
    public function orElse(mixed $value): mixed
    {
        if ($this->isSome()) {
            return $this->get();
        }

        if (is_callable($value)) {
            return $value();
        }

        return $value;
    }
}
