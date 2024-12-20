<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use Cerbero\Enum\Concerns\Enumerates;
use Illuminate\Support\Arr;

use function Symfony\Component\String\u;

use ValueError;

trait StringBackedEnumTrait
{
    use BackedEnumTrait, Enumerates {
        BackedEnumTrait::fromName insteadof Enumerates;
        BackedEnumTrait::tryFromName insteadof Enumerates;
        Enumerates::values insteadof BackedEnumTrait;
    }

    /**
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
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|string $value): static
    {
        if ($value instanceof static) {
            return $value;
        }

        try {
            return static::from($value);
        } catch (ValueError) {
            return static::fromName($value);
        }
    }

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

    public static function tryNormalizeToEnum(BackedEnum|string $value): ?static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::tryFrom($value) ?? static::tryFromName($value);
    }

    /**
     * Returns an array of normalized enums, skipping any null values.
     *
     * @return static[]
     */
    public static function normalizeToEnums(BackedEnum|string|array|null ...$values): array
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
    public static function tryNormalizeToEnums(BackedEnum|string|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return array_values(Arr::whereNotNull(Arr::map($values, function ($value) {
            return static::tryNormalizeToEnum($value);
        })));
    }

    /**
     * Returns an array of normalized values, skipping any null values.
     *
     * @return string[]
     */
    public static function normalizeToValues(BackedEnum|string|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return Arr::map($values, function ($value) {
            return static::normalizeToValue($value);
        });
    }

    /**
     * Returns an array of normalized values, skipping any null values.
     *
     * @return string[]
     */
    public static function tryNormalizeToValues(BackedEnum|string|array|null ...$values): array
    {
        $values = static::prepareNormalizeToArray($values);

        return array_values(Arr::whereNotNull(Arr::map($values, function ($value) {
            return static::tryNormalizeToValue($value);
        })));
    }

    public function transKey(): string
    {
        return u(basename(str_replace('\\', '/', get_class($this))))
            ->snake()
            ->prepend('enums', '.')
            ->append('.', $this->name);
    }
}
