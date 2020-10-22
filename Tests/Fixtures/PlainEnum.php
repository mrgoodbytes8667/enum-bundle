<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Spatie\Enum\Enum;

/**
 * Class PlainEnum
 * @package Bytes\EnumSerializerBundle\Tests\Fixtures
 *
 * @method static self channelCreate() Emitted whenever a channel is created.
 * @method static self channelDelete() Emitted whenever a channel is deleted.
 *
 * @link https://github.com/spatie/enum
 */
class PlainEnum extends Enum
{
}