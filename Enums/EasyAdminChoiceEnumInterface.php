<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use JetBrains\PhpStorm\Deprecated;

interface EasyAdminChoiceEnumInterface extends BackedEnum
{
    /**
     * @return array<string>
     */
    #[Deprecated('since 2.2, use provideFormChoices()', '%class%::provideFormChoices()')]
    public static function easyAdminChoices(): array;
}
