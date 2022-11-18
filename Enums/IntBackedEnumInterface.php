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
}
