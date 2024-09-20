<?php

use Atomicptr\Functional\Option;
use Atomicptr\Functional\Result;
use Atomicptr\Functional\ResultError;

test("Result::capture", function () {
    $res = Result::capture(fn () => 5);
    expect($res->hasError())->toBeFalse();
    expect($res->value())->toBe(5);

    $res = Result::capture(fn () => throw new \Exception("ERR"));
    expect($res->hasError())->toBeTrue();
});

test("Result::bind", function () {
    $res = Result::ok('{"api": "api response ig?"}')
        ->bind(fn (string $resp) => Result::capture(fn () => json_decode($resp, true, flags: JSON_THROW_ON_ERROR)))
        ->bind(fn (array $data) => Result::ok($data["api"]));
    expect($res->hasError())->toBeFalse();
    expect($res->value())->toBe("api response ig?");

    $res = Result::ok('this is not json smile')
        ->bind(fn (string $resp) => Result::capture(fn () => json_decode($resp, true, flags: JSON_THROW_ON_ERROR)))
        ->bind(fn (array $data) => Result::ok($data["api"]));
    expect($res->hasError())->toBeTrue();
});

test("Result::panic", function () {
    Result::error("something went wrong")->panic();
})->throws(ResultError::class);

test("Result::toOption", function () {
    $res = Result::error("something went wrong")->toOption();
    expect($res)->toBeInstanceOf(Option::class);
    expect($res->isNone())->toBeTrue();

    $res = Result::ok(1337)->toOption();
    expect($res)->toBeInstanceOf(Option::class);
    expect($res->isNone())->toBeFalse();
    expect($res->value())->toBe(1337);
});
