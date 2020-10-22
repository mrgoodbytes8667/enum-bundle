<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\BothEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\LabelsEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\ValuesEnum;

class DeserializationTest extends TestSerializationCase
{
    public function testPlainDeserialization()
    {
        $serializer = $this->createSerializer();

        $output = $serializer->deserialize($this->buildFixtureResponse('channelCreate'), PlainEnum::class, 'json');

        $this->assertEquals(PlainEnum::channelCreate(), $output);
    }

    public function testValuesDeserialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->deserialize($this->buildFixtureResponse('stream', 'streamChanged'), ValuesEnum::class, 'json');
        $this->assertEquals(ValuesEnum::streamChanged(), $output);
    }

    public function testLabelsDeserialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->deserialize($this->buildFixtureResponse('streamChanged', 'stream'), LabelsEnum::class, 'json');
        $this->assertEquals(LabelsEnum::streamChanged(), $output);
    }

    public function testBothDeserialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->deserialize($this->buildFixtureResponse('streamValue', 'streamLabel'), BothEnum::class, 'json');
        $this->assertEquals(BothEnum::streamChanged(), $output);
    }

    public function testPlainInheritedDeserialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->deserialize(json_encode(PlainInheritedEnum::channelCreate()), PlainInheritedEnum::class, 'json');
        $this->assertEquals(PlainInheritedEnum::channelCreate(), $output);
    }
}