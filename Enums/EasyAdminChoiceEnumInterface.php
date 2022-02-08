<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;

interface EasyAdminChoiceEnumInterface extends BackedEnum
{
    /**
     * @return array<string>
     */
    public static function easyAdminChoices(): array;
}
