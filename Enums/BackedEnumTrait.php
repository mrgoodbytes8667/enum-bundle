<?php

namespace Bytes\EnumSerializerBundle\Enums;

use function Symfony\Component\String\u;

/**
 * @method static array cases()
 */
trait BackedEnumTrait
{
    use EnumTrait;

    /**
     * @return array<string>
     */
    public static function easyAdminChoices(): array
    {
        $return = [];
        foreach (static::cases() as $value) {
            $return[u($value->name)->replace('-', '_')->snake()->replace('_', ' ')->title(true)->toString()] = $value->value;
        }

        return $return;
    }
}