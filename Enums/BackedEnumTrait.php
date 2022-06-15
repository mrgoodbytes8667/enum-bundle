<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use UnitEnum;
use ValueError;
use function Symfony\Component\String\u;

trait BackedEnumTrait
{
    /**
     * @return array<string>
     */
    public static function easyAdminChoices(): array
    {
        return static::provideFormChoices();
    }

    /**
     * @return array<string>
     */
    protected static function provideFormChoices(): array
    {
        $return = [];
        foreach (static::cases() as $value) {
            $return[u($value->name)->lower()->replace('_', ' ')->title(true)->toString()] = $value->value;
        }

        return $return;
    }

    /**
     * @return array<string>
     */
    public static function formChoices(): array
    {
        return static::provideFormChoices();
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

    public function equals(BackedEnum ...$others): bool
    {
        foreach ($others as $other) {
            if (
                get_class($this) === get_class($other)
                && $this->value === $other->value
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return UnitEnum
     */
    public static function random(): UnitEnum {
        $random = array_rand(static::cases());

        return static::cases()[$random];
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
