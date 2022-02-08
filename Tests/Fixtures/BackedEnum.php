<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\StringBackedEnumTrait;

enum BackedEnum: string implements StringBackedEnumInterface
{
    use StringBackedEnumTrait;

    case VALUE_A = 'a';
    case VALUE_B = 'b';
}