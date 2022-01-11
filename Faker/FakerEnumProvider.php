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
     *
     * @return UnitEnum|BackedEnum
     */
    public function randomEnum(string $enum): UnitEnum|BackedEnum
    {
        return static::randomElement($enum::cases());
    }

    /**
     * A random value of the enum you pass in.
     *
     * @param class-string<BackedEnum> $enum
     *
     * @return string|int
     */
    public function randomEnumValue(string $enum): int|string
    {
        return $this->randomEnum($enum)->value;
    }

    /**
     * A random label of the enum you pass in.
     *
     * @param class-string<BackedEnum> $enum
     * @deprecated since 1.6.1, this method is deprecated, there is no replacement.
     *
     * @return string
     */
    public function randomEnumLabel(string $enum): string
    {
        trigger_deprecation('mrgoodbytes8667/enum-serializer-bundle', '1.6.1', 'Using "%s" is deprecated, there is no replacement.', __METHOD__);
        return $this->randomEnumValue($enum);
    }

}