<?php

namespace Bytes\EnumSerializerBundle\Enums;

interface EasyAdminChoiceEnumInterface extends \BackedEnum
{
    /**
     * @return array<string>
     */
    public static function easyAdminChoices(): array;
}