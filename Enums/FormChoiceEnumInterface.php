<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use UnitEnum;
use function Symfony\Component\String\u;

interface FormChoiceEnumInterface extends BackedEnum
{
    /**
     * @return array<string>
     */
    public static function provideFormChoices(): array;

    /**
     * @return string
     */
    public function formChoiceKey(): string;

    /**
     * @param UnitEnum $value
     * @return string
     */
    public static function getFormChoiceKey(UnitEnum $value): string;

    /**
     * @param UnitEnum $value
     * @return string
     */
    public static function getFormChoiceValue(UnitEnum $value): string;
}
