<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Spatie\Enum\Enum;

/**
 * Class ValuesEnum
 * @package Bytes\EnumSerializerBundle\Tests\Fixtures
 *
 * @method static self streamChanged()
 * @method static self userChanged()
 *
 * @link https://github.com/spatie/enum
 */
class ValuesEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'streamChanged' => 'stream',
            'userChanged' => 'user',
        ];
    }
}