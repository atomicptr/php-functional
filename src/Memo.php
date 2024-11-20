<?php

namespace Atomicptr\Functional;

use Closure;

/**
 * Helper for creating memoized functions
 */
final class Memo
{
    private const HASH = "xxh3";

    private function __construct(
        private Closure $fn,
        private array $cache = [],
    ) {
    }

    /**
     * Call the memoized function, this has an internal cache and will
     * return the result of a prior call instead of calling it again
     *
     * @note All parameters MUST be Stringable
     */
    public function __invoke(mixed ...$params): mixed
    {
        $ident = $this->makeIdentifier($params);

        if (array_key_exists($ident, $this->cache)) {
            return $this->cache[$ident];
        }

        $this->cache[$ident] = call_user_func_array($this->fn, $params);
        return $this->cache[$ident];
    }

    private function makeIdentifier(array $params): string
    {
        return hash(static::HASH, Lst::foldl(fn (string $acc, mixed $param) => $acc . "::" . (string)$param, $params, "memo::"));
    }

    /**
     * Create a new memoized function from a Closure. This means we cache the result of the Closure using the parameters as the key.
     *
     * @note Keep in mind that the memoized function should be pure, otherwise it might not return what you expect on successive calls
     */
    public static function make(Closure $fn): static
    {
        return new Memo($fn);
    }
}
