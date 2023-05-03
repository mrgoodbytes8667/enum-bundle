<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT | Attribute::IS_REPEATABLE)]
class SampleRepeatableAttribute
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
