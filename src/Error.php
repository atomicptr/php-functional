<?php

namespace Atomicptr\Functional;

use PHPUnit\Event\Code\Throwable;
use Stringable;

final class Error extends Result
{
    public function __construct(
        private Stringable|Throwable|string $error
    ) {}

    public function bind(callable $fn): mixed
    {
        return $this;
    }

    public function get(): mixed
    {
        assert(false, "Can't get value from Error type, did you forget to check the value?");
    }

    public function errorValue(): string|Stringable|Throwable
    {
        return $this->error;
    }
}
