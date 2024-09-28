<?php

namespace Atomicptr\Functional\Traits;

use Atomicptr\Functional\Collection;
use Atomicptr\Functional\Lst;

trait EnumCollectionTrait
{
    public static function values(): array
    {
        $class = static::class;
        assert(Lst::every(fn (mixed $elem) => property_exists($elem, 'value') && $elem->value !== null, static::cases()), "One of the values of the enum: $class has no value, is this a backed enum?");
        return Lst::map(fn (mixed $elem) => $elem->value, static::cases());
    }

    public static function collection(): Collection
    {
        return Collection::from(static::cases());
    }

    public static function collectionValues(): Collection
    {
        return Collection::from(static::values());
    }

    public static function except(array $items): Collection
    {
        $col = static::collection();
        assert($col->every(fn (mixed $item) => in_array($item, static::cases())));
        return $col->filter(fn (mixed $item) => !in_array($item, $items));
    }
}
