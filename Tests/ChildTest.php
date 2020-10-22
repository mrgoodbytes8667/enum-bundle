<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\BothEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;

class ChildTest extends TestSerializationCase
{
    public function testIsValidFunction()
    {
        $this->assertTrue(PlainInheritedEnum::isValid('channelCreate'));
        $this->assertFalse(PlainInheritedEnum::isValid('abcdefg'));
    }

    /**
     * If this ever begins to fail, we won't need this bundle anymore!
     */
    public function testSpatieEnumWillNotSerializeAlone()
    {
        $serializer = $this->createSerializer(false, true);
        $output = $serializer->serialize(BothEnum::streamChanged(), 'json');
        $this->assertEquals('[]', $output);
    }
}