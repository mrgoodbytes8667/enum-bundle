<?php

namespace Bytes\EnumSerializerBundle\Enums;

use BackedEnum;
use UnitEnum;
use ValueError;
use function Symfony\Component\String\u;

/**
 * @method static BackedEnum random()
 */
trait BackedEnumTrait
{
    use UnitEnumTrait;

    /**
     * @return array<string>
     */
    public static function provideFormChoices(): array
    {
        $return = [];
        foreach (static::cases() as $value) {
            $return[static::getFormChoiceKey($value)] = static::getFormChoiceValue($value);
        }

        return $return;
    }

    /**
     * For usage in EasyAdminBundle until such time that #4988 is resolved
     * @return array<string, static>
     *
     * @link https://github.com/EasyCorp/EasyAdminBundle/pull/4988
     */
    public static function provideFormEnums(): array
    {
        $return = [];
        foreach (static::cases() as $value) {
            $return[static::getFormChoiceKey($value)] = $value;
        }

        return $return;
    }

    /**
     * @return string
     */
    public function formChoiceKey(): string
    {
        return u($this->name)->lower()->replace('_', ' ')->title(true)->toString();
    }

    /**
     * @param UnitEnum $value
     * @return string
     */
    public static function getFormChoiceKey(UnitEnum $value): string
    {
        return $value->formChoiceKey();
    }

    /**
     * @param UnitEnum $value
     * @return string
     */
    public static function getFormChoiceValue(UnitEnum $value): string
    {
        return $value->value;
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
     * @param BackedEnum ...$others
     * @return bool
     */
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
