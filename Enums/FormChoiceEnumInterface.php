<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use UnitEnum;

interface FormChoiceEnumInterface extends BackedEnum
{
    /**
     * @return array<string>
     */
    public static function provideFormChoices(): array;

    public function formChoiceKey(): string;

    public static function getFormChoiceKey(UnitEnum $value): string;

    public static function getFormChoiceValue(UnitEnum $value): string;
}
