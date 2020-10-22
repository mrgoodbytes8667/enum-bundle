<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\BothEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\LabelsEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\ValuesEnum;

class SerializationTest extends TestSerializationCase
{
    public function testPlainSerialization()
    {
        $serializer = $this->createSerializer();

        $output = $serializer->serialize(PlainEnum::channelCreate(), 'json');

        $this->assertEquals($this->buildFixtureResponse('channelCreate'), $output);
    }

    public function testValuesSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(ValuesEnum::streamChanged(), 'json');
        $this->assertEquals($this->buildFixtureResponse('stream', 'streamChanged'), $output);
    }

    public function testLabelsSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(LabelsEnum::streamChanged(), 'json');
        $this->assertEquals($this->buildFixtureResponse('streamChanged', 'stream'), $output);
    }

    public function testBothSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(BothEnum::streamChanged(), 'json');
        $this->assertEquals($this->buildFixtureResponse('streamValue', 'streamLabel'), $output);
    }

    public function testPlainInheritedSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(PlainInheritedEnum::channelCreate(), 'json');
        $this->assertEquals(json_encode(PlainInheritedEnum::channelCreate()), $output);
    }


}