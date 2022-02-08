<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;

class ChildTest extends TestSerializationCase
{
    /**
     * @return void
     */
    public function testIsValidFunction()
    {
        $this->assertNotNull(PlainInheritedEnum::tryFrom('channelCreate'));
        $this->assertNull(PlainInheritedEnum::tryFrom('abcdefg'));

        $this->assertTrue(PlainInheritedEnum::isValid('channelCreate'));
        $this->assertFalse(PlainInheritedEnum::isValid('abcdefg'));
    }
}