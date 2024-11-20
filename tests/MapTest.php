<?php

use Atomicptr\Functional\Exceptions\ImmutableException;
use Atomicptr\Functional\Map;
use Atomicptr\Functional\Option;

test("Map::from", function () {
    $map = Map::from(["a" => 42]);
    $value = $map->toArray()["a"];
    expect($value)->toBe(42);

    $map = Map::from(["zero", "one", "two"]);
    $value = $map->toArray()[1];
    expect($value)->toBe("one");
});

test("Map::get", function () {
    $map = Map::from(["a" => 42]);
    $value = $map->get("a");
    expect($value->isSome())->toBeTrue();
    expect($value->value())->toBe(42);
});

test("Map::set", function () {
    $map = Map::from(["a" => 42]);
    $map = $map->set("a", 1337);
    expect($map->get("a")->value())->toBe(1337);
});

test("Map::exists", function () {
    $map = Map::from(["a" => 42]);
    expect($map->exists("a"))->toBeTrue();

    $map = $map->set("f646c0ab21dc74aa", "test");
    expect($map->exists("f646c0ab21dc74aa"));

    $map = $map->set(10, 42);
    expect($map->exists(10));
});

test("Map::remove", function () {
    $map = Map::from(["a" => 42, "b" => 1337]);
    expect($map->exists("a"))->toBeTrue();
    $newMap = $map->remove("a");
    expect($map->exists("a"))->toBeTrue();
    expect($newMap->exists("a"))->toBeFalse();
});

test("Map::update", function () {
    $updateOrInit = fn (Option $value) => Option::some($value->isNone() ? 0 : $value->value() + 1);
    $map = Map::empty()
        ->update("a", $updateOrInit)
        ->update("a", $updateOrInit)
        ->update("a", $updateOrInit)
        ->update("a", $updateOrInit)
        ->update("a", $updateOrInit)
        ->update("a", $updateOrInit);
    expect($map->get("a")->isSome())->toBeTrue();
    expect($map->get("a")->value())->toBe(5);
});

test("Map::find", function () {
    $map = Map::from(["a" => 5]);

    $a = $map->find(fn (mixed $key) => $key === "a");
    expect($a->isSome())->toBeTrue();
    expect($a->value())->toBe(5);

    $b = $map->find(fn (mixed $key) => $key === "b");
    expect($b->isSome())->toBeFalse();
});

test("Map::union", function () {
    $a = Map::from(["a" => 5, "c" => 10]);
    $b = Map::from(["a" => 10, "b" => 10]);

    $res = $a->union($b);

    expect($res->get("a")->value())->toBe(10);
    expect($res->get("b")->value())->toBe(10);
    expect($res->get("c")->value())->toBe(10);
});

test("Map::intersect", function () {
    $a = Map::from(["a" => 5, "c" => 10]);
    $b = Map::from(["a" => 10, "b" => 10]);

    $res = $a->intersect($b);

    expect($res->get("a")->value())->toBe(10);
    expect($res->get("b")->isNone())->toBeTrue();
    expect($res->get("c")->value())->toBe(10);
});

test("Map::toList", function () {
    expect(Map::from(["a" => 10, "b" => 11])->toList())->toBe([["a", 10], ["b", 11]]);
});

test("Map::fromList", function () {
    expect(Map::fromList([["test", "yolo"], ["a", "b"]])->toArray())->toBe(["test" => "yolo", "a" => "b"]);
});

test("Map: Can be used like an PHP array", function () {
    $arr = [
        1 => "one",
        2 => "two",
        3 => "three",
    ];
    $map = Map::from($arr);
    expect($map[2])->toBe($arr[2]);
    expect($map)->toHaveLength(count($arr));

    $num = 0;

    foreach ($map as $key => $value) {
        expect($value)->toBe($arr[$key]);
        $num++;
    }

    expect($num)->toBe(count($arr));
});

test("Map: ArrayAccess set should throw", function () {
    $map = Map::from([1 => 1, 2 => 2, 3 => 3]);
    $map[1] = 999;
})->throws(ImmutableException::class);

test("Map: ArrayAccess unset should throw", function () {
    $map = Map::from([1 => 1, 2 => 2, 3 => 3]);
    unset($map[1]);
})->throws(ImmutableException::class);
