<?php

namespace Bytes\EnumSerializerBundle\Enums;

use ValueError;
use function Symfony\Component\String\u;

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

    /**
     * Helper method to determine if a supplied value is an enum value
     * @param string|int $value
     *
     * @return bool
     */
    public static function isValid($value): bool
    {
        try {
            $enum = static::from($value);
            return true;
        } catch (ValueError $exception) {
            return false;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return [
            'label' => $this->name,
            'value' => $this->value
        ];
    }
}
