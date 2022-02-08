<?php

namespace Bytes\EnumSerializerBundle\Enums;

interface EasyAdminChoiceEnumInterface extends BackedEnumInterface
{
    /**
     * @return array<string>
     */
    public static function easyAdminChoices(): array;
}
