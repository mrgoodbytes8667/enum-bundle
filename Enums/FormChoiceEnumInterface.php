<?php

namespace Bytes\EnumSerializerBundle\Enums;

interface FormChoiceEnumInterface extends BackedEnumInterface
{
    /**
     * @return array
     */
    public static function formChoices(): array;
}
