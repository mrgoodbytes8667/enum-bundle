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