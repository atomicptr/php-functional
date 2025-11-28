<?php

namespace Atomicptr\Functional;

use Atomicptr\Functional\Exceptions\ResultError;
use Exception;
use Stringable;
use Throwable;

/**
 * Represents a result of an operation that can either succeed with a value or fail with an error.
 *
 * @template T The type of the success value
 * @template Err of string|Stringable|Throwable The type of the error value
 */
final readonly class Result
{
    private const int VARIANT_OK = 0;
    private const int VARIANT_ERR = 1;

    private function __construct(
        private int $variant,
        private mixed $value = null,
    ) {}

    /**
     * Creates a successful Result containing the given value.
     *
     * @param T $value The success value
     * @return Ok<T> A Result representing success
     */
    public static function ok(mixed $value): static
    {
        return new Result(self::VARIANT_OK, $value);
    }

    /**
     * Creates a failed Result containing the given error.
     *
     * @param Err $error The error value
     * @return Error<Err> A Result representing failure
     */
    public static function error(string|Stringable|Throwable $error): static
    {
        return new Result(self::VARIANT_ERR, $error);
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
     * Checks if the Result is OK
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->variant === self::VARIANT_OK;
    }

    /**
     * Checks if this Result represents an error.
     *
     * @return bool True if this Result contains an error, false otherwise
     */
    public function hasError(): bool
    {
        return $this->variant === self::VARIANT_ERR;
    }

    /**
     * Returns the success value if this Result represents success.
     * Throws an assertion error if this Result represents an error.
     *
     * @return T The success value
     * @throws \AssertionError If this Result represents an error
     */
    public function get(): mixed
    {
        assert(!$this->hasError(), 'Result::value: Accessed Result that had an error');
        return $this->value;
    }

    /**
     * Returns the error value if this Result represents an error.
     * Throws an assertion error if this Result represents a successful value.
     *
     * @return T The success value
     * @throws \AssertionError If this Result represents an error
     */
    public function errorValue(): string|Stringable|Throwable
    {
        assert($this->hasError(), 'Result::value: Accessed Result that had a successful value');
        return $this->value;
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
        return Option::some($this->get());
    }

    /**
     * Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.
     *
     * @template U
     * @template UErr
     * @param callable(T): U|Error<U, UErr>
     * @return Result<U, UErr>
     */
    public function map(callable $fn): static
    {
        if ($this->hasError()) {
            return $this;
        }

        $res = $fn($this->get());
        if ($res instanceof Result) {
            return $res;
        }

        return static::ok($res);
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
        if ($this->isOk()) {
            return $this->get();
        }

        if (is_callable($value)) {
            return $value();
        }

        return $value;
    }

    /**
     * Creates an exception out of the error, for re-integration with a "normal" PHP environment that expects exceptions
     * @throws ResultError
     */
    public function panic(): void
    {
        throw new ResultError($this);
    }
}
