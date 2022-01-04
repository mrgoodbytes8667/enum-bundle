<?php


namespace Bytes\EnumSerializerBundle\Enums;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Deprecated;
use Spatie\Enum\Enum as ParentEnum;

/**
 * Class Enum
 * @package Bytes\EnumSerializerBundle\Enums
 */
abstract class Enum extends ParentEnum
{
    use EnumTrait;

    /** @psalm-readonly */
    #[Deprecated(reason: 'since 1.6.0, there is no label')]
    protected string $label;

    #[Deprecated(reason: 'since 1.7.0, use "cases()" instead.', replacement: '%class%::cases()')]
    public static function tempToValues(): array
    {
        return array_keys(static::tempToArray());
    }

    #[Deprecated(reason: 'since 1.7.0, use "cases()" instead.', replacement: '%class%::cases()')]
    public static function tempToArray(): array
    {
        return parent::toArray();
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