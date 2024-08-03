# php-functional

A set of tools to enable a more functional style of programming in PHP, inspired by [OCaml](https://ocaml.org/).

![](./.github/logo.png)

## Docs

### Class: Lst

A collection of functions for operations on "lists" (PHP arrays actually)

**Note**: Some of these are already implemented in the PHP standard lib however they are kinda inconsistent so they are also contained here

#### Lst::map(fn, list)

Applies function **fn** to every element of **list** and builds a new list with the results returned by fn.

Same as array_map

```php
<?php

$values = Lst::map(fn (int $num) => $num * $num, [1, 2, 3, 4, 5]);
$values // [1, 4, 9, 16, 25]
```

#### Lst::filter(fn, list)

Applies function **fn** to every element of **list** and builds a new list with the elements where **fn** returned true.

```php
<?php

$values = Lst::filter(fn (int $num) => $num > 3, [1, 2, 3, 4, 5]);
$values // [4, 5]
```

#### Lst::find(fn, list)

Iterates over **list** until one element applied to **fn** returns true

```php
<?php

$res = Lst::find(fn (int $num) => $num > 3, [1, 2, 3, 4, 5]);

assert($res->hasSome());
assert($res->value() === 4);
```

#### Lst::forAll(fn, lst)

Iterates over **lst** and executes the function **fn** for every one of these

Same as a foreach loop with a function call

```php
<?php

Lst::forAll(fn (int $num) => echo "Num: $num\n", [11, 22, 33]);

// Prints:
//    Num: 11
//    Num: 22
//    Num: 33
```

#### Lst::foldl(fn, lst, \[initial\])

Folds the **lst** into a single value, accumulator is located left.

Same as array_reduce

```php
<?php

$total = Lst::foldl(fn (int $acc, int $value) => $acc + $value, [2, 3, 4]);

assert($total === 9);
```

#### Lst::foldr(fn, lst, \[initial\])

Folds the **lst** into a single value, accumulator is located right.

Same as array_reduce (but with the accumulator at the right)

```php
<?php

$total = Lst::foldr(fn (int $value, int $acc) => $acc + $value, [2, 3, 4]);

assert($total === 9);
```

#### Lst::some(fn, lst)

Checks if the predicate **fn** is true for ONE element in **lst**

```php
<?php

$anyOdd = Lst::some(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8]);
assert($anyOdd === false);

$anyOdd = Lst::some(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8, 9]);
assert($anyOdd === true);
```

#### Lst::every

Checks if the predicate **fn** is true for ALL elements in **lst**

```php
<?php

$allEven = Lst::every(fn (int $num) => $num % 2 === 0, [2, 4, 6, 8, 10]);
assert($allEven === true);
```


### Class: Collection

Collection is a wrapper around PHP arrays that provides the functionality of list in a way that allows you to
easily pipe them together. Almost all functions are the same as with Lst see:

```php
<?php

function sumOfSquaredEvenNumbers(array $lst) {
    return Collection::from([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
        ->filter(fn (int $num) => $num % 2 === 0)
        ->map(fn (int $num) => $num * $num)
        ->foldl(fn (int $acc, int $value) => $acc + $value, 0);
}
```

### Class: Option

Option values explicitly indicate the presence or absence of a value.

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

Result values handle computation results and errors in an explicit and declarative manner without resorting to exceptions.

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
