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
            $return[u($value->name)->lower()->replace('_', ' ')->title(true)->toString()] = $value->value;
        }

        return $return;
    }

    /**
     * @return string[]|int[]
     */
    public static function values(): array
    {
        return array_map(function ($e) {
            return $e->value;
        }, static::cases());
    }
}