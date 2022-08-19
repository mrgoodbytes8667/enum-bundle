<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use JetBrains\PhpStorm\Deprecated;

interface FormChoiceEnumInterface extends BackedEnum
{
    /**
     * @return array
     */
    #[Deprecated('since 2.2, use provideFormChoices()', '%class%::provideFormChoices()')]
    public static function formChoices(): array;
}
