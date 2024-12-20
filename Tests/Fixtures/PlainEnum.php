<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;

enum PlainEnum: string
{
    use BackedEnumTrait;

    case channelCreate = 'channelCreate'; // Emitted whenever a channel is created.
    case channelDelete = 'channelDelete'; // Emitted whenever a channel is deleted.
}
