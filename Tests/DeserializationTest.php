<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\ValuesEnum;
use Generator;

/**
 * Class DeserializationTest
 * @package Bytes\EnumSerializerBundle\Tests
 */
class DeserializationTest extends TestSerializationCase
{
    /**
     * @param string $data
     * @param string $type
     * @param string|int $expected
     *
     * @dataProvider provideDeserializationData
     */
    public function testDeserialization(string $data, string $type, $expected)
    {
        $serializer = $this->createSerializer();
        $output = $serializer->deserialize($data, $type, 'json');
        $this->assertEquals($expected, $output);
    }

    /**
     * @return Generator
     */
    public function provideDeserializationData(): Generator
    {
        yield ['data' => $this->buildFixtureResponse('channelCreate'), 'type' => PlainEnum::class, 'expected' => PlainEnum::channelCreate];
        yield ['data' => $this->buildFixtureResponse('stream', 'streamChanged'), 'type' => ValuesEnum::class, 'expected' => ValuesEnum::streamChanged];
        yield ['data' => json_encode(PlainInheritedEnum::channelCreate), 'type' => PlainInheritedEnum::class, 'expected' => PlainInheritedEnum::channelCreate];

        yield ['data' => json_encode(PlainEnum::channelCreate), 'type' => PlainEnum::class, 'expected' => PlainEnum::channelCreate];
        yield ['data' => json_encode(ValuesEnum::streamChanged), 'type' => ValuesEnum::class, 'expected' => ValuesEnum::streamChanged];
        yield ['data' => json_encode(PlainInheritedEnum::channelCreate), 'type' => PlainInheritedEnum::class, 'expected' => PlainInheritedEnum::channelCreate];
        
        yield ['data' => json_encode(PlainEnum::channelCreate->value), 'type' => PlainEnum::class, 'expected' => PlainEnum::channelCreate];
        yield ['data' => json_encode(ValuesEnum::streamChanged->value), 'type' => ValuesEnum::class, 'expected' => ValuesEnum::streamChanged];
        yield ['data' => json_encode(PlainInheritedEnum::channelCreate->value), 'type' => PlainInheritedEnum::class, 'expected' => PlainInheritedEnum::channelCreate];
    }
}