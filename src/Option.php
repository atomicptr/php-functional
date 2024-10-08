<?php

namespace Atomicptr\Functional;

/**
 * Represents an optional value: every Option is either Some and contains a value, or None, and does not.
 * This type is used in cases where a value may or may not be present.
 *
 * @template T
 */
final readonly class Option
{
    private function __construct(
        private bool $hasValue,
        private mixed $value,
    ) {
    }

    /**
     * Creates a Some variant of Option containing the given value.
     *
     * @param T $value The value to wrap in Some.
     * @return Option<T> An Option containing the value.
     */
    public static function some(mixed $value): static
    {
        return new static(true, $value);
    }

    /**
     * Creates a None variant of Option, representing the absence of a value.
     *
     * @return Option<T> An Option representing no value.
     */
    public static function none(): static
    {
        return new static(false, null);
    }

    /**
     * Checks if this Option is a Some variant.
     *
     * @return bool True if this Option is Some, false otherwise.
     */
    public function isSome(): bool
    {
        return $this->hasValue;
    }

    /**
     * Checks if this Option is a None variant.
     *
     * @return bool True if this Option is None, false otherwise.
     */
    public function isNone(): bool
    {
        return !$this->hasValue;
    }

    /**
     * Returns the contained value if this Option is Some.
     * Throws an assertion error if this Option is None.
     *
     * @return T The contained value.
     * @throws \AssertionError If this Option is None.
     */
    public function value(): mixed
    {
        assert($this->hasValue, "Option::value: Accessed Optional that has no value");
        return $this->value;
    }

    /**
     * Applies a function to the contained value (if any) and returns the result.
     * If this Option is None, returns None without calling the function.
     *
     * @template U
     * @param callable(T): Option<U> $fn The function to apply to the contained value.
     * @return Option<U> The result of applying the function, or None if this Option is None.
     */
    public function bind(callable $fn): static
    {
        if ($this->isNone()) {
            return $this;
        }

        $res = $fn($this->value());
        assert($res instanceof static, "Option::bind closure must return an Option");

        return $res;
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
            return $this->value();
        }

        if (is_callable($value)) {
            return $value();
        }

        return $value;
    }

    /**
     * Returns a collection of T when it has a value, otherwise returns an empty collection.
     *
     * @return Collection<T>
     */
    public function collection(): Collection
    {
        if ($this->isNone()) {
            return Collection::from([]);
        }
        return Collection::from([$this->value()]);
    }
}
