<?php

namespace Atomicptr\Functional;

interface Monad
{
    public function get(): mixed;
    public function bind(callable $fn): mixed;
}
