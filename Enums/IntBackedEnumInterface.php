<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use ValueError;

interface IntBackedEnumInterface extends BackedEnumInterface
{
    /**
     * @param BackedEnum|int $value
     * @return int
     * @throws ValueError
     */
    public static function normalizeToValue(BackedEnum|int $value): int;

    /**
     * @param BackedEnum|int $value
     * @return static
     * @throws ValueError
     */
    public static function normalizeToEnum(BackedEnum|int $value): static;

    /**
     * @param BackedEnum|int $value
     * @return int|null
     */
    public static function tryNormalizeToValue(BackedEnum|int $value): ?int;

    /**
     * @param BackedEnum|int $value
     * @return static|null
     */
    public static function tryNormalizeToEnum(BackedEnum|int $value): ?static;

    /**
     * Returns an array of normalized enums, skipping any null values
     * @param BackedEnum|int|array|null ...$values
     * @return static[]
     */
    public static function normalizeToEnums(BackedEnum|int|array|null ...$values): array;

    /**
     * Returns an array of normalized enums, skipping any null values
     * @param BackedEnum|int|array|null ...$values
     * @return static[]
     */
    public static function tryNormalizeToEnums(BackedEnum|int|array|null ...$values): array;

    /**
     * Returns an array of normalized values, skipping any null values
     * @param BackedEnum|int|array|null ...$values
     * @return int[]
     */
    public static function normalizeToValues(BackedEnum|int|array|null ...$values): array;

    /**
     * Returns an array of normalized values, skipping any null values
     * @param BackedEnum|int|array|null ...$values
     * @return int[]
     */
    public static function tryNormalizeToValues(BackedEnum|int|array|null ...$values): array;
}
