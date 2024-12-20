<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use Cerbero\Enum\Concerns\Enumerates;
use Illuminate\Support\Arr;
use ValueError;

trait IntBackedEnumTrait
{
    use BackedEnumTrait, Enumerates {
        BackedEnumTrait::fromName insteadof Enumerates;
        BackedEnumTrait::tryFromName insteadof Enumerates;
        Enumerates::values insteadof BackedEnumTrait;
    }

    /**
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
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|int $value): static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::from($value);
    }

    public static function tryNormalizeToValue(BackedEnum|int $value): ?int
    {
        if ($value instanceof static) {
            return $value->value;
        } elseif (is_int($value) && !is_null(static::tryFrom($value))) {
            return $value;
        } else {
            return null;
        }
    }

    public static function tryNormalizeToEnum(BackedEnum|int $value): ?static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::tryFrom($value);
    }

    /**
     * Returns an array of normalized enums, skipping any null values.
     *
     * @return static[]
     */
    public static function normalizeToEnums(BackedEnum|int|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return Arr::map($values, function ($value) {
            return static::normalizeToEnum($value);
        });
    }

    /**
     * Returns an array of normalized enums, skipping any null values.
     *
     * @return static[]
     */
    public static function tryNormalizeToEnums(BackedEnum|int|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return array_values(Arr::whereNotNull(Arr::map($values, function ($value) {
            return static::tryNormalizeToEnum($value);
        })));
    }

    /**
     * Returns an array of normalized values, skipping any null values.
     *
     * @return int[]
     */
    public static function normalizeToValues(BackedEnum|int|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return Arr::map($values, function ($value) {
            return static::normalizeToValue($value);
        });
    }

    /**
     * Returns an array of normalized values, skipping any null values.
     *
     * @return int[]
     */
    public static function tryNormalizeToValues(BackedEnum|int|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return array_values(Arr::whereNotNull(Arr::map($values, function ($value) {
            return static::tryNormalizeToValue($value);
        })));
    }
}
