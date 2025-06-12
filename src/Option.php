<?php

namespace Atomicptr\Functional;

use Deprecated;

/**
 * Represents an optional value: every Option is either Some and contains a value, or None, and does not.
 * This type is used in cases where a value may or may not be present.
 *
 * @template T
 */
abstract class Option implements Monad
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
     * @throws \AssertionError If this Option is None.
     */
    #[Deprecated('Use ->get() instead')]
    public function value(): mixed
    {
        assert($this->isSome(), 'Option::value: Accessed Optional that has no value');
        return $this->get();
    }

    /**
     * Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.
     *
     * @template U
     * @param callable(T): U|Option<U>
     * @return Option<U>
     */
    public function flatMap(callable $fn): static
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
     * @param U|callable(): U
     * @return T|U
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
