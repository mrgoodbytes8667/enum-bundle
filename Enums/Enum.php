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
            $enum = static::make($value);
            return true;
        } catch (BadMethodCallException | TypeError $exception) {
            return false;
        }
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