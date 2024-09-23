<?php

use Atomicptr\Functional\Collection;
use Atomicptr\Functional\Exceptions\ImmutableException;

test("Collection: Can be used like an array", function () {
    $arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    $col = Collection::from($arr);
    expect($col[5])->toBe(5);
    expect($col)->toHaveLength(count($arr));

    $num = 0;

    foreach ($col as $index => $item) {
        expect($item)->toBe($arr[$index]);
        $num++;
    }

    expect($num)->toBe(count($arr));
});

test("Collection: ArrayAccess set should throw", function () {
    $col = Collection::from([1, 2, 3]);
    $col[1] = 999;
})->throws(ImmutableException::class);

test("Collection: ArrayAccess unset should throw", function () {
    $col = Collection::from([1, 2, 3]);
    unset($col[1]);
})->throws(ImmutableException::class);
