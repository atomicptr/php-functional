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
    private const int VARIANT_NONE = 0;
    private const int VARIANT_SOME = 1;

    private function __construct(
        private int $variant,

        /**
         * @var T|null
         */
        private mixed $value = null,
    ) {}

    /**
     * Creates a Some variant of Option containing the given value.
     *
     * @param T $value The value to wrap in Some.
     * @return Some<T> An Option containing the value.
     */
    public static function some(mixed $value): static
    {
        return new Option(self::VARIANT_SOME, $value);
    }

    /**
     * Creates a None variant of Option, representing the absence of a value.
     *
     * @return None An Option representing no value.
     */
    public static function none(): static
    {
        return new Option(self::VARIANT_NONE);
    }

    /**
     * Checks if this Option is a Some variant.
     *
     * @return bool True if this Option is Some, false otherwise.
     */
    public function isSome(): bool
    {
        return $this->variant === self::VARIANT_SOME;
    }

    /**
     * Checks if this Option is a None variant.
     *
     * @return bool True if this Option is None, false otherwise.
     */
    public function isNone(): bool
    {
        return $this->variant === self::VARIANT_NONE;
    }

    /**
     * Returns the contained value if this Option is Some.
     * Throws an assertion error if this Option is None.
     *
     * @return T The contained value.
     * @throws \AssertionError If this Option is None.
     */
    public function get(): mixed
    {
        assert($this->isSome(), 'Option::value: Accessed Optional that has no value');
        return $this->value;
    }

    /**
     * Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.
     *
     * @template U
     * @param callable(T): U|Option<U>
     * @return Option<U>
     */
    public function map(callable $fn): static
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
