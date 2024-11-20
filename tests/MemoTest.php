<?php

use Atomicptr\Functional\Lst;
use Atomicptr\Functional\Memo;

$fib = null;

test("Memo::make", function () {
    $called = [];

    $fib = Memo::make(function (int $n) use (&$fib, &$called) {
        assert(Lst::find(fn (int $i) => $i === $n, $called)->isNone(), "no memoized function should ever be called twice");
        $called[] = $n;

        return $n <= 1 ? $n : $fib($n - 1) + $fib($n - 2);
    });

    expect($fib(12))->toBe(144);
    expect($fib(10))->toBe(55);
});
