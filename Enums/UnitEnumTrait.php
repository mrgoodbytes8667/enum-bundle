<?php

namespace Bytes\EnumSerializerBundle\Enums;

use UnitEnum;

trait UnitEnumTrait
{
    /**
     * @return UnitEnum
     */
    public static function random(): UnitEnum
    {
        $random = array_rand(static::cases());

        return static::cases()[$random];
    }
}
