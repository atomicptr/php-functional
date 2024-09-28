<?php

use Atomicptr\Functional\Traits\EnumCollectionTrait;

enum Suit
{
    use EnumCollectionTrait;

    case Hearts;
    case Diamonds;
    case Clubs;
    case Spades;
}

enum Numbers: int
{
    use EnumCollectionTrait;

    case ONE = 1;
    case TWO = 2;
    case THREE = 3;
};

test("EnumCollectionTrait::values", function () {
    expect(Numbers::values())->toBe([1, 2, 3]);
});

test("EnumCollectionTrait::values without Backed Enum", function () {
    Suit::values();
})->throws(AssertionError::class);

test("EnumCollectionTrait::collection", function () {
    $cases = Suit::cases();
    $casesCol = Suit::collection();

    expect($casesCol->length())->toBe(count($cases));
    expect($casesCol->every(fn (Suit $item) => in_array($item, $cases)))->toBeTrue();
});

test("EnumCollectionTrait::collectionValues", function () {
    $values = Numbers::values();
    expect($values)->toHaveLength(count($values));
    expect(Numbers::collectionValues()->every(fn (int $num) => in_array($num, $values)))->toBeTrue();
});

test("EnumCollectionTrait::except", function () {
    $cases = Suit::except([Suit::Diamonds, Suit::Spades]);
    expect($cases->length())->toBe(2);
    expect($cases->every(fn (Suit $item) => in_array($item, [Suit::Hearts, Suit::Clubs])))->toBeTrue();
});
