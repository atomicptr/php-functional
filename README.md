# php-functional

A set of tools to enable a more functional approach in PHP

## Docs

### Class: Lst

A collection of functions for operations on "lists" (PHP arrays actually)

**Note**: Some of these are already implemented in the PHP standard lib however they are kinda inconsistent so they are also contained here

#### Lst::map

TODO

```php
<?php

$values = Lst::map(fn (int $num) => $num * $num, [1, 2, 3, 4, 5]);
$values // [1, 4, 9, 16, 25]
```

#### Lst::filter

TODO

```php
<?php

$values = Lst::filter(fn (int $num) => $num > 3, [1, 2, 3, 4, 5]);
$values // [4, 5]
```

#### Lst::find

TODO

```php
<?php

$res = Lst::find(fn (int $num) => $num > 3, [1, 2, 3, 4, 5]);

assert($res->hasSome());
assert($res->value() === 4);
```

#### Lst::forAll

TODO

```php
<?php

Lst::forAll(fn (int $num) => echo "Num: $num\n", [11, 22, 33]);

// Prints:
//    Num: 11
//    Num: 22
//    Num: 33
```

#### Lst::foldl

TODO

```php
<?php

$total = Lst::foldl(fn (int $acc, int $value) => $acc + $value, [2, 3, 4]);

assert($total === 9);
```

#### Lst::foldr

TODO

```php
<?php

$total = Lst::foldr(fn (int $value, int $acc) => $acc + $value, [2, 3, 4]);

assert($total === 9);
```

#### Lst::some

TODO

```php
<?php

$anyOdd = Lst::some(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8]);
assert($anyOdd === false);

$anyOdd = Lst::some(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8, 9]);
assert($anyOdd === true);
```

#### Lst::every

TODO

```php
<?php

$allEven = Lst::every(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]);
assert($allEven === true);
```


### Class: Collection

#### Collection->toArray
#### Collection->has
#### Collection->get
#### Collection->map
#### Collection->filter
#### Collection->forAll
#### Collection->find
#### Collection->foldl
#### Collection->foldr
#### Collection->some
#### Collection->every

### Class: Option

```php
<?php

use Atomicptr\Functional\Option;

function safeDivision(int|float $a, int|float $b): Option {
    if ($b === 0) {
        return Option::none();
    }
    return Option::some($a / $b);
}

$a = safeDivision(10, 2);

if ($a->hasSome()) {
    echo "10 / 2 = " . $a->value() . "\n";
} else {
    echo "10 / 2 = ERROR";
}

$b = safeDivision(10, 0);

if ($b->hasSome()) {
    echo "10 / 0 = " . $b->value() . "\n";
} else {
    echo "10 / 0 = ERROR";
}

// This will print
//    10 / 2 = 5
//    10 / 0 = ERROR
```

### Class: Result

```php
<?php

use Atomicptr\Functional\Result;

function safeDivision(int|float $a, int|float $b): Result {
    if ($b === 0) {
        return Result::error(new CantDivideByZeroException());
    }
    return Result::ok($a / $b);
}

$a = safeDivision(10, 2);

if (!$a->hasError()) {
    echo "10 / 2 = " . $a->value() . "\n";
} else {
    echo "10 / 2 = " . $a->errorValue()->toString();
}

$b = safeDivision(10, 0);

if (!$b->hasError()) {
    echo "10 / 0 = " . $b->value() . "\n";
} else {
    echo "10 / 0 = " . $a->errorValue()->toString();
}

// This will print
//    10 / 2 = 5
//    10 / 0 = Whatever we specified in the exception
```

## License

MIT
