<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;

enum ValuesEnum: string
{
    use BackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
}
