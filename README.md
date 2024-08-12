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
````

## Install

The package is available on [packagist](https://packagist.org/packages/atomicptr/functional)

Install via:

```bash
$ composer req atomicptr/functional
````

## Docs

### Atomicptr\Functional

* [Lst](docs/Lst.md) 
* [Collection](docs/Collection.md) 
* [Option](docs/Option.md) 
* [Result](docs/Result.md)

## License

MIT
