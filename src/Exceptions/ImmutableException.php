<?php

namespace Atomicptr\Functional\Exceptions;

use RuntimeException;
use Throwable;

class ImmutableException extends RuntimeException
{
    public const CODE = 1727081676;

    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            'Attempted to modify an immutable object.',
            static::CODE,
            $previous,
        );
    }
}
