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
        return new static(array_values($array));
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function has(mixed $index): bool
    {
        return isset($this->data[$index]);
    }

    public function get(mixed $index): Option
    {
        if (!$this->has($index)) {
            return Option::none();
        }
        return Option::some($this->data[$index]);
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

    public function find(callable $fn): Option
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

    public function length(): int
    {
        return Lst::length($this->data);
    }

    public function hd(): mixed
    {
        return Lst::hd($this->data);
    }

    public function tl(): static
    {
        return static::from(Lst::tl($this->data));
    }

    public function rev(): static
    {
        return static::from(Lst::rev($this->data));
    }

    public function append(Collection $collection): static
    {
        return static::from(Lst::append($this->data, $collection->data));
    }

    public function flatten(): static
    {
        return static::from(Lst::flatten($this->data));
    }
}
