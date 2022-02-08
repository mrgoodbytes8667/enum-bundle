<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;

interface FormChoiceEnumInterface extends BackedEnum
{
    /**
     * @return array
     */
    public static function formChoices(): array;
}
