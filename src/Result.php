<?php

namespace Atomicptr\Functional;

use Stringable;

final readonly class Result
{
    private function __construct(
        private mixed $value,
        private string|Stringable|null $error,
    ) {
    }

    public static function ok(mixed $value): static
    {
        return new static($value, null);
    }

    public static function error(string|Stringable $error): static
    {
        return new static(null, $error);
    }

    public function hasError(): bool
    {
        return $this->error !== null;
    }

    public function errorValue(): string|Stringable|null
    {
        return $this->error;
    }

    public function value(): mixed
    {
        assert(!$this->hasError(), "Accessed Result that had an error: " . $this->errorValue());
        return $this->value;
    }

    public function bind(callable $fn): static
    {
        if ($this->hasError()) {
            return $this;
        }

        $res = $fn($this);
        assert($res instanceof static);

        return $res;
    }
}
