<?php

namespace Bytes\EnumSerializerBundle\Faker;

use BackedEnum;
use Faker\Provider\Base;
use UnitEnum;

class FakerEnumProvider extends Base
{
    /**
     * A random instance of the enum you pass in.
     *
     * @param class-string<UnitEnum|BackedEnum> $enum
     */
    public function randomEnum(string $enum): UnitEnum|BackedEnum
    {
        return static::randomElement($enum::cases());
    }

    /**
     * A random value of the enum you pass in.
     *
     * @param class-string<BackedEnum> $enum
     */
    public function randomEnumValue(string $enum): int|string
    {
        return $this->randomEnum($enum)->value;
    }
}
