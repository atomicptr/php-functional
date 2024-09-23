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

test("EnumCollectionTrait::collection", function () {
    $cases = Suit::cases();
    $casesCol = Suit::collection();

    expect($casesCol->length())->toBe(count($cases));
    expect($casesCol->every(fn (Suit $item) => in_array($item, $cases)))->toBeTrue();
});

test("EnumCollectionTrait::except", function () {
    $cases = Suit::except([Suit::Diamonds, Suit::Spades]);
    expect($cases->length())->toBe(2);
    expect($cases->every(fn (Suit $item) => in_array($item, [Suit::Hearts, Suit::Clubs])))->toBeTrue();
});
