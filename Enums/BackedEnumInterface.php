<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use JsonSerializable;

interface BackedEnumInterface extends BackedEnum, JsonSerializable
{
    /**
     * @return string[]|int[]
     */
    public static function values(): array;

    /**
     * Helper method to determine if a supplied value is an enum value
     * @param string|int $value
     *
     * @return bool
     */
    public static function isValid($value): bool;
}

