<?php

use Atomicptr\Functional\Option;

test("Option::bind", function () {
    $res = Option::some("test")->bind(fn () => Option::some("yes"));
    expect($res->isNone())->toBeFalse();
    expect($res->value())->toBe("yes");

    $res = Option::none()->bind(fn () => Option::some("yes"));
    expect($res->isNone())->toBeTrue();
});
