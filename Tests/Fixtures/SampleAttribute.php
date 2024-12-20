<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class SampleAttribute
{
    public function __construct(private readonly string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
