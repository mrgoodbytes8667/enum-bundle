<?php

namespace Bytes\EnumSerializerBundle\Faker;

class FakerEnumProvider extends \Spatie\Enum\Faker\FakerEnumProvider
{
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