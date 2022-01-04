<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\BothEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;

class ChildTest extends TestSerializationCase
{
    /**
     * @return void
     */
    public function testIsValidFunction()
    {
        $this->assertTrue(PlainInheritedEnum::isValid('channelCreate'));
        $this->assertFalse(PlainInheritedEnum::isValid('abcdefg'));
    }

    /**
     * @return void
     */
    public function testMake() {
        $this->assertEquals(PlainInheritedEnum::from('channelCreate'), PlainInheritedEnum::make('channelCreate'));
    }

    /**
     * @return void
     */
    public function testDeprecatedGetToFunctions() {
        $this->assertCount(2, PlainInheritedEnum::getLabels());
        $this->assertCount(2, PlainInheritedEnum::toLabels());
        $this->assertCount(2, PlainInheritedEnum::getValues());
        $this->assertCount(2, PlainInheritedEnum::toValues());
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