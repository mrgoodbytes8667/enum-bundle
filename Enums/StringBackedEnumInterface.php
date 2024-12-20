<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use ValueError;

interface StringBackedEnumInterface extends BackedEnumInterface
{
    /**
     * @throws ValueError
     */
    public static function normalizeToValue(BackedEnum|string $value): string;

    /**
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|string $value): static;

    public static function tryNormalizeToValue(BackedEnum|string $value): ?string;

    public static function tryNormalizeToEnum(BackedEnum|string $value): ?static;

    /**
     * Returns an array of normalized enums, skipping any null values.
     *
     * @return static[]
     */
    public static function normalizeToEnums(BackedEnum|string|array|null ...$values): array;

    /**
     * Returns an array of normalized enums, skipping any null values.
     *
     * @return static[]
     */
    public static function tryNormalizeToEnums(BackedEnum|string|array|null ...$values): array;

    /**
     * Returns an array of normalized values, skipping any null values.
     *
     * @return string[]
     */
    public static function normalizeToValues(BackedEnum|string|array|null ...$values): array;

    /**
     * Returns an array of normalized values, skipping any null values.
     *
     * @return string[]
     */
    public static function tryNormalizeToValues(BackedEnum|string|array|null ...$values): array;
}
