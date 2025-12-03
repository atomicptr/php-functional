<?php

namespace Atomicptr\Functional\Variants\Option;

use Atomicptr\Functional\Exceptions\InvariantViolationException;
use Atomicptr\Functional\Option;

/**
 * Represents the non existance of a value.
 * @see Option
 */
final readonly class None extends Option
{
    /**
     * Can't get value from None type, did you forget to check the value?
     * @return never
     * @throws InvariantViolationException
     */
    public function get(): mixed
    {
        throw new InvariantViolationException("Can't get value from None type, did you forget to check the value?");
    }
}
