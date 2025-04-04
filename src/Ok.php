<?php

namespace Atomicptr\Functional;

final class Ok extends Result
{
    public function __construct(
        private mixed $value
    ) {}

    public function bind(callable $fn): mixed
    {
        $res = $fn($this->value);
        assert($res instanceof Result);
        return $res;
    }

    public function get(): mixed
    {
        return $this->value;
    }
}
