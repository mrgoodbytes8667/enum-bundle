<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Bytes\EnumSerializerBundle\Enums\UnitEnumTrait;

enum UnbackedEnum
{
    use UnitEnumTrait;

    case A;
    case B;
}
