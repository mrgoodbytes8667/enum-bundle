<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Spatie\Enum\Enum;

/**
 * Class BothEnum
 * @package Bytes\EnumSerializerBundle\Tests\Fixtures
 *
 * @method static self streamChanged()
 * @method static self userChanged()
 *
 * @link https://github.com/spatie/enum
 */
class BothEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'streamChanged' => 'streamLabel',
            'userChanged' => 'userLabel',
        ];
    }
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'streamChanged' => 'streamValue',
            'userChanged' => 'userValue',
        ];
    }
}