<?php


namespace Bytes\EnumSerializerBundle\Enums;


use BadMethodCallException;
use Spatie\Enum\Enum as ParentEnum;
use TypeError;

/**
 * Class Enum
 * @package Bytes\EnumSerializerBundle\Enums
 */
abstract class Enum extends ParentEnum
{
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
        } catch (BadMethodCallException | TypeError $exception) {
            return false;
        }
    }

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return static::labels();
    }

    /**
     * @return string[]|int[]
     */
    public static function getValues(): array
    {
        return static::values();
    }

    /**
     * @return array|int|string
     */
    public function jsonSerialize()
    {
        return [
            'label' => $this->label,
            'value' => $this->value
        ];
    }
}