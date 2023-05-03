<?php

namespace Bytes\EnumSerializerBundle\Tests\Fixtures;

use Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\StringBackedEnumTrait;

enum BackedEnumWithAttributes: string implements StringBackedEnumInterface
{
    use StringBackedEnumTrait;

    #[SampleAttribute('The value is a')]
    case VALUE_A = 'a';

    #[SampleRepeatableAttribute('The value is b')]
    #[SampleRepeatableAttribute('The value is still b')]
    case VALUE_B = 'b';

    public function getSampleAttribute() {
        return $this->getAttribute(SampleAttribute::class);
    }

    public function getSampleAttributes() {
        return $this->getAttributes(SampleAttribute::class);
    }

    public function getSampleRepeatableAttribute() {
        return $this->getAttribute(SampleRepeatableAttribute::class);
    }

    public function getSampleRepeatableAttributes() {
        return $this->getAttributes(SampleRepeatableAttribute::class);
    }
}
