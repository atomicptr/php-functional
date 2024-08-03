<?php

use Atomicptr\Functional\Lst;

test("Lst::find", function () {
    $res = Lst::find(fn (int $num) => $num % 2 === 0, [1, 3, 5, 6, 10]);
    expect($res->isSome())->toBeTrue();
    expect($res->value())->toBe(6);

    $res = Lst::find(fn (int $num) => $num % 2 === 0, [1, 3, 5, 7]);
    expect($res->isSome())->toBeFalse();
    expect($res->isNone())->toBeTrue();
});

test("Lst::forAll", function () {
   $vars = [1, 2, 3, 4];

   Lst::forAll(function (int $num, int $index) use($vars) {
       expect($num)->toBe($vars[$index]);
   }, $vars);
});

test("Lst::some", function () {
    expect(Lst::some(fn (int $num) => $num % 2 === 0, [1, 3, 5, 7, 10]))->toBeTrue();
});

test("Lst::every", function () {
    expect(Lst::every(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]))->toBeTrue();
});
