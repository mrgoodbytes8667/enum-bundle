<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;

interface EasyAdminChoiceEnumInterface extends BackedEnum
{
    /**
     * For usage in EasyAdminBundle until such time that #4988 is resolved
     * @return array<string, static>
     *
     * @link https://github.com/EasyCorp/EasyAdminBundle/pull/4988
     */
    public static function provideFormEnums(): array;
}
