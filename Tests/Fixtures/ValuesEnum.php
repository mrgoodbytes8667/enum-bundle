<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Bytes\EnumSerializerBundle\Enums\BackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;

enum ValuesEnum: string implements BackedEnumInterface
{
    use BackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
}
