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

    Lst::forAll(function (int $num, int $index) use ($vars) {
        expect($num)->toBe($vars[$index]);
    }, $vars);
});

test("Lst::some", function () {
    expect(Lst::some(fn (int $num) => $num % 2 === 0, [1, 3, 5, 7, 10]))->toBeTrue();
});

test("Lst::every", function () {
    expect(Lst::every(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]))->toBeTrue();
});

test("Lst::hd", function () {
    expect(Lst::hd([1, 2]))->toBe(1);
});

test("Lst::tl", function () {
    expect(Lst::tl([1, 2]))->toBe([2]);
    expect(Lst::tl([1, 2, 3, 4]))->toBe([2, 3,4]);
    expect(Lst::tl([1]))->toBe([]);
    expect(Lst::tl([]))->toBe([]);
});

test("Lst::init", function () {
    expect(Lst::init(fn (int $num) => $num + 1, 3))->toBe([1, 2, 3]);
});

test("Lst::append", function () {
    expect(Lst::append([1, 2, 3], [4, 5, 6]))->toBe([1, 2, 3, 4, 5, 6]);
});

test("Lst::flatten", function () {
    expect(Lst::flatten([[[1, 2], 3], [4, [5]], 6]))->toBe([1, 2, 3, 4, 5, 6]);
});
