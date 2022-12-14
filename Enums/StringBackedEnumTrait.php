<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use ValueError;

trait StringBackedEnumTrait
{
    use BackedEnumTrait;

    /**
     * @param BackedEnum|string $value
     * @return string
     * @throws ValueError
     */
    public static function normalizeToValue(BackedEnum|string $value): string
    {
        if ($value instanceof static) {
            return $value->value;
        } elseif (is_string($value) && !is_null(static::from($value))) {
            return $value;
        } else {
            throw new ValueError(sprintf('The supplied value cannot be normalized for the "%s" enum.', __CLASS__));
        }
    }

    /**
     * @param BackedEnum|string $value
     * @return static
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|string $value): static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::from($value);
    }


    /**
     * @param BackedEnum|string $value
     * @return string|null
     */
    public static function tryNormalizeToValue(BackedEnum|string $value): ?string
    {
        if ($value instanceof static) {
            return $value->value;
        } elseif (is_string($value) && !is_null(static::tryFrom($value))) {
            return $value;
        } else {
            return null;
        }
    }

    /**
     * @param BackedEnum|string $value
     * @return static|null
     */
    public static function tryNormalizeToEnum(BackedEnum|string $value): ?static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::tryFrom($value);
    }
}