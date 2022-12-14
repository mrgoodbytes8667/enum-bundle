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
}
