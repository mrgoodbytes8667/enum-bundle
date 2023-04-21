<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use ValueError;

interface StringBackedEnumInterface extends BackedEnumInterface
{
    /**
     * @param BackedEnum|string $value
     * @return string
     * @throws ValueError
     */
    public static function normalizeToValue(BackedEnum|string $value): string;

    /**
     * @param BackedEnum|string $value
     * @return static
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|string $value): static;

    /**
     * @param BackedEnum|string $value
     * @return string|null
     */
    public static function tryNormalizeToValue(BackedEnum|string $value): ?string;

    /**
     * @param BackedEnum|string $value
     * @return static|null
     */
    public static function tryNormalizeToEnum(BackedEnum|string $value): ?static;

    /**
     * Returns an array of normalized enums, skipping any null values
     * @param BackedEnum|string|array|null ...$values
     * @return static[]
     */
    public static function normalizeToEnums(BackedEnum|string|array|null ...$values): array;

    /**
     * Returns an array of normalized enums, skipping any null values
     * @param BackedEnum|string|array|null ...$values
     * @return static[]
     */
    public static function tryNormalizeToEnums(BackedEnum|string|array|null ...$values): array;

    /**
     * Returns an array of normalized values, skipping any null values
     * @param BackedEnum|string|array|null ...$values
     * @return string[]
     */
    public static function normalizeToValues(BackedEnum|string|array|null ...$values): array;

    /**
     * Returns an array of normalized values, skipping any null values
     * @param BackedEnum|string|array|null ...$values
     * @return string[]
     */
    public static function tryNormalizeToValues(BackedEnum|string|array|null ...$values): array;
}
