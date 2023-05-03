<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class SampleAttribute
{
    /**
     * @param string $value
     */
    public function __construct(private string $value)
    {
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
