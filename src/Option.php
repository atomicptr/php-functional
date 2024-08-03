<?php

namespace Atomicptr\Functional;

final readonly class Option
{
    private function __construct(
        private bool $hasValue,
        private mixed $value,
    ) {
    }

    public static function some(mixed $value): static
    {
        return new static(true, $value);
    }

    public static function none(): static
    {
        return new static(false, null);
    }

    public function isSome(): bool
    {
        return $this->hasValue;
    }

    public function isNone(): bool
    {
        return !$this->hasValue;
    }

    public function value(): mixed
    {
        assert($this->hasValue, "Accessed Optional that has no value");
        return $this->value;
    }

    public function bind(callable $fn): static
    {
        if ($this->isNone()) {
            return $this;
        }

        $res = $fn($this);
        assert($res instanceof static);

        return $res;
    }
}
