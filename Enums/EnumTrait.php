<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BadMethodCallException;
use TypeError;

/**
 * @method static from(int|string $value)
 */
trait EnumTrait
{
    /**
     * Helper method to determine if a supplied value is an enum value
     * @param string|int $value
     *
     * @return bool
     */
    public static function isValid($value): bool
    {
        try {
            $enum = static::from($value);
            return true;
        } catch (BadMethodCallException|TypeError $exception) {
            return false;
        }
    }
}