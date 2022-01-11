<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;

enum BackedEnum: string
{
    use BackedEnumTrait;

    case VALUE_A = 'a';
    case VALUE_B = 'b';
}