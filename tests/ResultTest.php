<?php

use Atomicptr\Functional\Result;

test("Result::capture", function () {
    $res = Result::capture(fn () => 5);
    expect($res->hasError())->toBeFalse();
    expect($res->value())->toBe(5);

    $res = Result::capture(fn () => throw new \Exception("ERR"));
    expect($res->hasError())->toBeTrue();
});

test("Result::bind", function () {
    $res = Result::ok("test")->bind(fn () => Result::ok("yes"));
    expect($res->hasError())->toBeFalse();
    expect($res->value())->toBe("yes");

    $res = Result::error("nope")->bind(fn () => Result::ok("yes"));
    expect($res->hasError())->toBeTrue();
});
