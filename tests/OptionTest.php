<?php

use Atomicptr\Functional\Option;

test('Option::map', function () {
    $res = Option::some('test')->map(fn(string $str) => strtoupper($str));
    expect($res->isSome())->toBeTrue();
    expect($res->get())->toBe('TEST');

    $res = Option::some('test')->map(fn(string $str) => Option::some(strtoupper($str)));
    expect($res->isSome())->toBeTrue();
    expect($res->get())->toBe('TEST');

    $res = Option::none()->map(fn(string $str) => strtoupper($str));
    expect($res->isNone())->toBeTrue();
});

test('Option::orElse', function () {
    $res = Option::some('test')->orElse(fn() => 'yes');
    expect($res)->toBe('test');

    $res = Option::none()->orElse(fn() => 'yes');
    expect($res)->toBe('yes');

    $res = Option::none()->orElse('yes');
    expect($res)->toBe('yes');
});
