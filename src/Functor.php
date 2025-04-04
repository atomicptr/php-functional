<?php

namespace Atomicptr\Functional;

interface Functor
{
    public function map(callable $fn): static;
}
