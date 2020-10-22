<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Spatie\Enum\Enum;

/**
 * Class LabelsEnum
 * @package Bytes\EnumSerializerBundle\Tests\Fixtures
 *
 * @method static self streamChanged()
 * @method static self userChanged()
 *
 * @link https://github.com/spatie/enum
 */
class LabelsEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'streamChanged' => 'stream',
            'userChanged' => 'user',
        ];
    }
}