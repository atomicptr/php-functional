<?php

use Atomicptr\Functional\Option;

test('Option::bind', function () {
    $res = Option::some('test')->bind(fn(string $text) => Option::some($text === 'test' ? 'yes' : 'nope'));
    expect($res->isNone())->toBeFalse();
    expect($res->get())->toBe('yes');

    $res = Option::none()->bind(fn(string $text) => Option::some($text === 'test' ? 'yes' : 'nope'));
    expect($res->isNone())->toBeTrue();
});

test('Option::flatMap', function () {
    $res = Option::some('test')->flatMap(fn(string $str) => strtoupper($str));
    expect($res->isSome())->toBeTrue();
    expect($res->get())->toBe('TEST');

    $res = Option::some('test')->flatMap(fn(string $str) => Option::some(strtoupper($str)));
    expect($res->isSome())->toBeTrue();
    expect($res->get())->toBe('TEST');

    $res = Option::none()->flatMap(fn(string $str) => strtoupper($str));
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
