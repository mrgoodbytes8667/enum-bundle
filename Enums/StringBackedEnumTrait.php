<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use ValueError;

/**
 * @method static string[] values()
 */
trait StringBackedEnumTrait
{
    use BackedEnumTrait;

    /**
     * @param BackedEnum|string $value
     * @return string
     */
    public static function normalizeToValue(self|string $value): string
    {
        if ($value instanceof static) {
            return $value->value;
        } elseif (!is_null(static::tryFrom($value))) {
            return $value;
        } else {
            throw new ValueError(sprintf('The value "%s" is not a value for the "%s" enum.', $value, __CLASS__));
        }
    }

    /**
     * @param BackedEnum|string $value
     * @return static
     */
    public static function normalizeToEnum(self|string $value): static
    {
        if ($value instanceof static) {
            return $value;
        }

        $value = static::tryFrom($value);
        if (!is_null($value)) {
            return $value;
        } else {
            throw new ValueError(sprintf('The value "%s" is not a value for the "%s" enum.', $value, __CLASS__));
        }
    }
}