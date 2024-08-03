<?php

namespace Atomicptr\Functional;

/**
 * A wrapper around PHP arrays enabling piping several functions together
 */
final class Collection
{
    private function __construct(
        private array $data = [],
    ) {
    }

    public static function from(array $array): static
    {
        return new static($array);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function map(callable $fn): static
    {
        return static::from(Lst::map($fn, $this->data));
    }

    public function filter(callable $fn): static
    {
        return static::from(Lst::filter($fn, $this->data));
    }

    public function forAll(callable $fn): void
    {
        return Lst::forAll($fn, $this->data);
    }

    public function find(callable $fn): mixed
    {
        return Lst::find($fn, $this->data);
    }

    public function foldl(callable $fn, mixed $initial = null): mixed
    {
        return Lst::foldl($fn, $this->data, $initial);
    }

    public function foldr(callable $fn, mixed $initial = null): mixed
    {
        return Lst::foldr($fn, $this->data, $initial);
    }

    public function some(callable $fn): bool
    {
        return Lst::some($fn, $this->data);
    }

    public function every(callable $fn): bool
    {
        return Lst::every($fn, $this->data);
    }
}
