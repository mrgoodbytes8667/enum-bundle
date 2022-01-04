<?php

namespace Bytes\EnumSerializerBundle\Faker;

use Spatie\Enum\Enum;

class FakerEnumProvider extends \Spatie\Enum\Faker\FakerEnumProvider
{
    /**
     * A random instance of the enum you pass in.
     *
     * @param class-string<\Bytes\EnumSerializerBundle\Enums\Enum> $enum
     *
     * @return Enum
     */
    public function randomEnum(string $enum): Enum
    {
        if (! is_subclass_of($enum, \Bytes\EnumSerializerBundle\Enums\Enum::class)) {
            throw new InvalidArgumentException(sprintf(
                'You have to pass the FQCN of a "%s" class but you passed "%s".',
                Enum::class,
                $enum
            ));
        }

        return $enum::make(static::randomElement($enum::tempToValues()));
    }

    /**
     * A random label of the enum you pass in.
     * @param string $enum
     *
     * @return string
     * @deprecated since 1.7.0, this method is deprecated, there is no replacement.
     *
     */
    public function randomEnumLabel(string $enum): string
    {
        trigger_deprecation('mrgoodbytes8667/enum-serializer-bundle', '1.7.0', 'Using "%s" is deprecated, there is no replacement.', __METHOD__);
        return parent::randomEnumLabel($enum);
    }
}