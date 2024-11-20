# php-functional

A set of tools to enable a more functional style of programming in PHP, inspired by [OCaml](https://ocaml.org/).

<img src="https://cdn.jsdelivr.net/gh/atomicptr/php-functional/.github/logo.png" height="150" />

```php
<?php

// lots of list utility functions
list($even, $odd) = Lst::partition(fn (int $num) => $num % 2 === 0, [1, 2, 3, 4, 5, 6]);
//     $even is [2, 4, 6]
//     $odd is  [1, 3, 5]

// pipe a bunch of operations
Collection::from(Lst::init(fn (int $index) => $index * $index, 100))
    ->filter(fn (int $num) => $num % 2 === 0)
    ->filter(fn (int $num) => $num > 50)
    ->map(fn (int $num, int $index) => $num * $index)
    ->foldl(fn (int $acc, int $val) => $acc + $val, 0);

// better error handling with Result
function safeDivision(int $a, int $b): Result
{
    if ($b === 0) {
        return Result::error("cant divide by 0");
    }

    return Result::ok($a / $b);
}

$res = safeDivision(10, 2);

if ($res->hasError()) {
    print($res->value());
    exit(1);
}

// use bind for Result or Option to only continue as long as there is a value
// lets assume we have a function fetch(string $url): Result that just returns
// the response as a string wrapped into Result
$title = fetch("https://atomicptr.dev/api/blog/post/1337")
    ->bind(fn (string $response) => Result::capture(fn () => json_decode($resp, true, flags: JSON_THROW_ON_ERROR)))
    ->bind(function (array $data) {
        assert(BlogPostSchema::isValid($data)); // A ficticious json schema validator
        return BlogPostResource::createFrom($data); // This converts the json data into a structure
    })->bind(fn (BlogPost $post) => $post->title());

if ($title->hasError()) {
    // something went wrong along the chain, so just panic
    $title->panic();
    exit(1);
}

// express "nothing" without using null
function findOneById(int $id): Option
{
    $rows = DB::find("table_name", ["id" => $id]);

    if (empty($rows)) {
        return Option::none();
    }

    return Option::some($rows[0]);
}

$row = findOneById(1337);

if ($row->isNone()) {
    print("Can not find object 1337");
    exit(1);
}

// ...

// maps
$incrementer = fn (Option $value) => $value->isSome() ? Option::some($value->value() + 1 : 1;
$map = Map::empty()
    ->update("a", $incrementer)
    ->update("a", $incrementer)
    ->update("b", $incrementer)
    ->set("c", 5);

$map->get("a"); // 3
$map->get("b"); // 1

// group products by type
$productsByType = Lst::groupBy(fn (Product $product) => $product->getType()->toString(), Product::all());
$productsByType->get("electronics") // [Product, Product]

// memoize functions
$f = Memo::make(fn (int $a, int $b) => doSomethingHeavy($a, $b));
$res = $f(1337, 8080); // this will call "doSomethingHeavy" which might take a while
// ...
$res = $f(1337, 8080); // now we call it again but it will now instantly return the result because we already called it with 1 and 2
````

## Install

The package is available on [packagist](https://packagist.org/packages/atomicptr/functional)

Install via:

```bash
$ composer req atomicptr/functional
````

## Docs

### Atomicptr\Functional

* [Lst](./docs/Lst.md)
* [Collection](./docs/Collection.md)
* [Option](./docs/Option.md)
* [Result](./docs/Result.md)
* [Map](./docs/Map.md)

### Atomicptr\Functional\Traits

* [EnumCollectionTrait](./docs/Traits/EnumCollectionTrait.md)

### Atomicptr\Functional\Exceptions

* [ResultError](./docs/Exceptions/ResultError.md)
* [ImmutableException](./docs/Exceptions/ImmutableException.md)

## License

MIT
