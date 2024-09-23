<?php

namespace Atomicptr\Functional\Traits;

use Atomicptr\Functional\Collection;

trait EnumCollectionTrait
{
    public static function collection(): Collection
    {
        return Collection::from(static::cases());
    }

    public static function except(array $items): Collection
    {
        $col = static::collection();
        assert($col->every(fn (mixed $item) => in_array($item, static::cases())));
        return $col->filter(fn (mixed $item) => !in_array($item, $items));
    }
}
