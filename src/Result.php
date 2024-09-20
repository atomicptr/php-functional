<?php

namespace Atomicptr\Functional;

use Stringable;
use Throwable;

/**
 * Represents a result of an operation that can either succeed with a value or fail with an error.
 *
 * @template T The type of the success value
 * @template Err of string|Stringable The type of the error value
 */
final readonly class Result
{
    private function __construct(
        private mixed $value,
        private string|Stringable|null $error,
    ) {
    }

    /**
     * Creates a successful Result containing the given value.
     *
     * @param T $value The success value
     * @return Result<T, Err> A Result representing success
     */
    public static function ok(mixed $value): static
    {
        return new static($value, null);
    }

    /**
     * Creates a failed Result containing the given error.
     *
     * @param Err $error The error value
     * @return Result<T, Err> A Result representing failure
     */
    public static function error(string|Stringable $error): static
    {
        return new static(null, $error);
    }

    /**
     * Executes a function and captures its result or any thrown exception into a Result.
     *
     * @param callable(): T $fn The function to execute
     * @return Result<T, Err> A Result containing either the function's return value or the caught exception
     */
    public static function capture(callable $fn): Result
    {
        try {
            $val = $fn();
            return static::ok($val);
        } catch (Throwable $err) {
            return static::error($err);
        }
    }

    /**
     * Checks if this Result represents an error.
     *
     * @return bool True if this Result contains an error, false otherwise
     */
    public function hasError(): bool
    {
        return $this->error !== null;
    }

    /**
     * Returns the error value if this Result represents an error.
     *
     * @return Err|null The error value, or null if this Result represents success
     */
    public function errorValue(): string|Stringable|null
    {
        return $this->error;
    }

    /**
     * Returns the success value if this Result represents success.
     * Throws an assertion error if this Result represents an error.
     *
     * @return T The success value
     * @throws \AssertionError If this Result represents an error
     */
    public function value(): mixed
    {
        assert(!$this->hasError(), "Result::value: Accessed Result that had an error: " . $this->errorValue());
        return $this->value;
    }

    /**
     * Applies a function to the success value (if any) and returns the result.
     * If this Result represents an error, returns the original error Result without calling the function.
     *
     * @template U
     * @template E
     * @param callable(T): Result<U, E> $fn The function to apply to the success value
     * @return Result<U, E> The result of applying the function, or the original error Result
     */
    public function bind(callable $fn): static
    {
        if ($this->hasError()) {
            return $this;
        }

        $res = $fn($this->value());
        assert($res instanceof static, "Result::bind closure must return a Result");

        return $res;
    }

    /**
     * Result as an Option, mapping Result::ok(...) to Option::some(...) and Result::error(...) to Option::none()
     *
     * @return Option<T>
     */
    public function toOption(): Option
    {
        if ($this->hasError()) {
            return Option::none();
        }
        return Option::some($this->value());
    }

    /**
     * Creates an exception out of the error, for re-integration with a "normal" PHP environment that expects exceptions
     * @throws ResultError
     */
    public function panic(): void
    {
        throw new ResultError($this);
    }

    /**
     * Returns a collection of T when it has a value, otherwise returns an empty collection.
     *
     * @return Collection<T>
     */
    public function collection(): Collection
    {
        if ($this->hasError()) {
            return Collection::from([]);
        }
        return Collection::from([$this->value()]);
    }
}
