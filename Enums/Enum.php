<?php


namespace Bytes\EnumSerializerBundle\Enums;


use BadMethodCallException;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Deprecated;
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
     * @param string|int $value
     *
     * @return static
     */
    #[Deprecated(reason: 'since 1.3.1, use from() instead', replacement: '%class%::from(%parameter0%)')]
    public static function make($value): Enum
    {
        return static::from($value);
    }

    /**
     * @return string[]
     */
    #[Deprecated(reason: 'since 1.5.0, use "toLabels()" instead.', replacement: '%class%::toLabels()')]
    public static function getLabels(): array
    {
        trigger_deprecation('mrgoodbytes8667/enum-serializer-bundle', '1.5.0', 'Using "%s" is deprecated, use "%s()" instead.', __METHOD__, 'toLabels');
        return static::toLabels();
    }

    /**
     * @return string[]|int[]
     */
    #[Deprecated(reason: 'since 1.5.0, use "toValues()" instead.', replacement: '%class%::toValues()')]
    public static function getValues(): array
    {
        trigger_deprecation('mrgoodbytes8667/enum-serializer-bundle', '1.5.0', 'Using "%s" is deprecated, use "%s()" instead.', __METHOD__, 'toValues');
        return static::toValues();
    }

    /**
     * @return array|int|string
     */
    #[ArrayShape(['label' => "string", 'value' => "int|string"])]
    public function jsonSerialize()
    {
        return [
            'label' => $this->label,
            'value' => $this->value
        ];
    }
}