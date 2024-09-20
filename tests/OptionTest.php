<?php

use Atomicptr\Functional\Collection;
use Atomicptr\Functional\Option;

test("Option::bind", function () {
    $res = Option::some("test")->bind(fn (string $text) => Option::some($text === "test" ? "yes" : "nope"));
    expect($res->isNone())->toBeFalse();
    expect($res->value())->toBe("yes");

    $res = Option::none()->bind(fn (string $text) => Option::some($text === "test" ? "yes" : "nope"));
    expect($res->isNone())->toBeTrue();
});

test("Option::orElse", function () {
    $res = Option::some("test")->orElse(fn () => "yes");
    expect($res)->toBe("test");

    $res = Option::none()->orElse(fn () => "yes");
    expect($res)->toBe("yes");

    $res = Option::none()->orElse("yes");
    expect($res)->toBe("yes");
});

test("Option::collection", function () {
    $col = Option::some("test")->collection();
    expect($col)->toBeInstanceOf(Collection::class);
    expect($col->length())->toBe(1);
    expect($col->first())->toBe("test");

    $col = Option::none()->collection();
    expect($col)->toBeInstanceOf(Collection::class);
    expect($col->length())->toBe(0);
});
