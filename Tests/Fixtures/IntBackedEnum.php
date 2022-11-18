<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Bytes\EnumSerializerBundle\Enums\IntBackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\IntBackedEnumTrait;

enum IntBackedEnum: int implements IntBackedEnumInterface
{
    use IntBackedEnumTrait;

    case zero = 0;
    case one = 1;
}
