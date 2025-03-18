<?php

use Atomicptr\Functional\Lst;

test('Lst::map', function () {
    // make sure that index is passed
    expect(Lst::map(fn(int $val, int $index) => $val + $index, [5, 4, 3, 2, 1]))->toBe([5, 5, 5, 5, 5]);
});

test('Lst::filter', function () {
    expect(Lst::filter(fn(int $val) => $val % 2 === 0, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]))->toBe([2, 4, 6, 8, 10]);
});

test('Lst::partition', function () {
    list($even, $odd) = Lst::partition(fn(int $num) => $num % 2 === 0, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
    expect($even)->toBe([2, 4, 6, 8, 10]);
    expect($odd)->toBe([1, 3, 5, 7, 9]);
});

test('Lst::find', function () {
    $res = Lst::find(fn(int $num) => $num % 2 === 0, [1, 3, 5, 6, 10]);
    expect($res->isSome())->toBeTrue();
    expect($res->value())->toBe(6);

    $res = Lst::find(fn(int $num) => $num % 2 === 0, [1, 3, 5, 7]);
    expect($res->isSome())->toBeFalse();
    expect($res->isNone())->toBeTrue();
});

test('Lst::findIndex', function () {
    $res = Lst::findIndex(fn(int $num) => $num % 2 === 0, [1, 3, 5, 6, 10]);
    expect($res->isSome())->toBeTrue();
    expect($res->value())->toBe(3);

    $res = Lst::findIndex(fn(int $num) => $num % 2 === 0, [1, 3, 5, 7]);
    expect($res->isSome())->toBeFalse();
    expect($res->isNone())->toBeTrue();
});

test('Lst::forAll', function () {
    $vars = [1, 2, 3, 4];

    Lst::forAll(function (int $num, int $index) use ($vars) {
        expect($num)->toBe($vars[$index]);
    }, $vars);
});

test('Lst::some', function () {
    expect(Lst::some(fn(int $num) => $num % 2 === 0, [1, 3, 5, 7, 10]))->toBeTrue();
});

test('Lst::every', function () {
    expect(Lst::every(fn(int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]))->toBeTrue();
});

test('Lst::hd', function () {
    expect(Lst::hd([1, 2]))->toBe(1);
});

test('Lst::tl', function () {
    expect(Lst::tl([1, 2]))->toBe([2]);
    expect(Lst::tl([1, 2, 3, 4]))->toBe([2, 3, 4]);
    expect(Lst::tl([1]))->toBe([]);
    expect(Lst::tl([]))->toBe([]);
});

test('Lst::first', function () {
    expect(Lst::first([1, 2, 3, 4]))->toBe(1);
});

test('Lst::second', function () {
    expect(Lst::second([1, 2, 3, 4]))->toBe(2);
});

test('Lst::third', function () {
    expect(Lst::third([1, 2, 3, 4]))->toBe(3);
});

test('Lst::last', function () {
    expect(Lst::last([1, 2, 3, 4]))->toBe(4);
});

test('Lst::init', function () {
    expect(Lst::init(fn(int $num) => $num + 1, 3))->toBe([1, 2, 3]);
});

test('Lst::append', function () {
    expect(Lst::append([1, 2, 3], [4, 5, 6]))->toBe([1, 2, 3, 4, 5, 6]);
});

test('Lst::cons', function () {
    $arr = [1, 2, 3, 4];
    expect(Lst::cons($arr, 5))->toBe([1, 2, 3, 4, 5]);

    // make sure the original array is unchanged
    expect($arr)->toBe([1, 2, 3, 4]);
});

test('Lst::flatten', function () {
    expect(Lst::flatten([[[1, 2], 3], [4, [5]], 6]))->toBe([1, 2, 3, 4, 5, 6]);
});

test('Lst::take', function () {
    expect(Lst::take([1, 2, 3, 4, 5], 2))->toBe([1, 2]);
    expect(Lst::take([1, 2, 3, 4, 5], 3))->toBe([1, 2, 3]);
    expect(Lst::take([1, 2, 3, 4, 5], 0))->toBe([]);
    expect(Lst::take([1, 2, 3, 4, 5], 10))->toBe([1, 2, 3, 4, 5]);
});

test('Lst::takeWhile', function () {
    expect(Lst::takeWhile(fn(int $num) => $num % 2 === 0, [2, 4, 6, 7, 10]))->toBe([2, 4, 6]);
    expect(Lst::takeWhile(fn(int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]))->toBe([2, 4, 6, 8, 10]);
    expect(Lst::takeWhile(fn(int $num) => $num % 2 === 0, [1, 2, 4, 6, 8, 10]))->toBe([]);
});

test('Lst::drop', function () {
    expect(Lst::drop([1, 2, 3, 4, 5], 2))->toBe([3, 4, 5]);
    expect(Lst::drop([1, 2, 3, 4, 5], 3))->toBe([4, 5]);
    expect(Lst::drop([1, 2, 3, 4, 5], 0))->toBe([1, 2, 3, 4, 5]);
    expect(Lst::drop([1, 2, 3, 4, 5], 10))->toBe([]);
});

test('Lst::dropWhile', function () {
    expect(Lst::dropWhile(fn(int $num) => $num % 2 === 0, [2, 4, 6, 7, 10]))->toBe([7, 10]);
    expect(Lst::dropWhile(fn(int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]))->toBe([]);
    expect(Lst::dropWhile(fn(int $num) => $num % 2 === 0, [1, 2, 4, 6, 8, 10]))->toBe([1, 2, 4, 6, 8, 10]);
});

test('Lst::slice', function () {
    expect(Lst::slice([1, 2, 3, 4, 5, 6, 7, 8]))->toBe([1, 2, 3, 4, 5, 6, 7, 8]);
    expect(Lst::slice([1, 2, 3, 4, 5, 6, 7, 8], 1))->toBe([2, 3, 4, 5, 6, 7, 8]);
    expect(Lst::slice([1, 2, 3, 4, 5, 6, 7, 8], 2))->toBe([3, 4, 5, 6, 7, 8]);
    expect(Lst::slice([1, 2, 3, 4, 5, 6, 7, 8], 2, 1))->toBe([3]);
    expect(Lst::slice([1, 2, 3, 4, 5, 6, 7, 8], 2, 4))->toBe([3, 4, 5, 6]);
    expect(Lst::slice([1, 2, 3, 4, 5, 6, 7, 8], 2, 100))->toBe([3, 4, 5, 6, 7, 8]);
});

test('Lst::sort', function () {
    $lst = [5, 100, 4, 3, 2, 1];
    expect(Lst::sort(fn(int $a, int $b) => $a <=> $b, $lst))->toBe([1, 2, 3, 4, 5, 100]);
    expect($lst)->toBe([5, 100, 4, 3, 2, 1]);  // original list is unchanged
});

test('Lst::unique', function () {
    $lst = [0, 1, 2, 1, 3, 4, 3, 5, 5, 6, 6, 6];
    expect(Lst::unique($lst))->toBe([0, 1, 2, 3, 4, 5, 6]);
});

test('Lst::sortUnique', function () {
    $lst = [100, 1, 2, 1, 3, 4, 3, 5, 5, 6, 6, 6, 0];
    expect(Lst::sortUnique(fn(int $a, int $b) => $a <=> $b, $lst))->toBe([0, 1, 2, 3, 4, 5, 6, 100]);

    $lst = [[100, 'C'], [50, 'B'], [10, 'A'], [100, 'C']];
    expect(Lst::sortUnique(fn(array $a, array $b) => Lst::first($a) <=> Lst::first($b), $lst))->toBe([[10, 'A'], [50, 'B'], [100, 'C']]);
});

test('Lst::groupBy', function () {
    $result = Lst::groupBy(fn(int $num) => $num % 2 === 0 ? 'even' : 'odd', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
    expect($result->get('even')->value())->toBe([2, 4, 6, 8, 10]);
    expect($result->get('odd')->value())->toBe([1, 3, 5, 7, 9]);
});
