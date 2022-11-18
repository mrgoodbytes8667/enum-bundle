<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use ValueError;

trait IntBackedEnumTrait
{
    use BackedEnumTrait;

    /**
     * @param BackedEnum|int $value
     * @return int
     * @throws ValueError
     */
    public static function normalizeToValue(BackedEnum|int $value): int
    {
        if ($value instanceof static) {
            return $value->value;
        } elseif (is_int($value) && !is_null(static::from($value))) {
            return $value;
        } else {
            throw new ValueError(sprintf('The supplied value cannot be normalized for the "%s" enum.', __CLASS__));
        }
    }

    /**
     * @param BackedEnum|int $value
     * @return static
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|int $value): static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::from($value);
    }
}
