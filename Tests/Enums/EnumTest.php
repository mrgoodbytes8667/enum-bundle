<?php

namespace Bytes\EnumSerializerBundle\Tests\Enums;

use Bytes\EnumSerializerBundle\PhpUnit\EnumAssertions;
use Bytes\EnumSerializerBundle\Tests\Fixtures\BackedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\LabelsEnum;
use Generator;
use PHPUnit\Framework\TestCase;
use ValueError;

class EnumTest extends TestCase
{
    /**
     * @return void
     */
    public function testEasyAdminChoices()
    {
        $this->assertCount(2, BackedEnum::easyAdminChoices());
    }

    /**
     * @return void
     */
    public function testValues()
    {
        $this->assertCount(2, BackedEnum::values());
        $values = BackedEnum::values();

        $value = array_shift($values);
        $this->assertEquals('a', $value);

        $value = array_shift($values);
        $this->assertEquals('b', $value);
    }

    public function testEquals()
    {
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::VALUE_A));
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::VALUE_A, BackedEnum::VALUE_A));
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::VALUE_A, BackedEnum::VALUE_B));
        $this->assertFalse(BackedEnum::VALUE_A->equals(BackedEnum::VALUE_B));

        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::from('a')));
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::from('a'), BackedEnum::VALUE_A));
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::from('a'), BackedEnum::from('b')));
        $this->assertFalse(BackedEnum::VALUE_A->equals(BackedEnum::from('b')));

        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::tryFrom('a')));
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::tryFrom('a'), BackedEnum::VALUE_A));
        $this->assertTrue(BackedEnum::VALUE_A->equals(BackedEnum::tryFrom('a'), BackedEnum::tryFrom('b')));
        $this->assertFalse(BackedEnum::VALUE_A->equals(BackedEnum::tryFrom('b')));
    }

    /**
     * @dataProvider provideAll
     * @param $enum
     * @param $value
     * @return void
     */
    public function testAll($enum, $value)
    {
        EnumAssertions::assertIsEnum($enum);
        EnumAssertions::assertEqualsEnum($enum, $value);
        EnumAssertions::assertSameEnumValue($enum, $value);
    }

    /**
     * @return Generator
     */
    public function provideAll(): Generator
    {
        foreach (BackedEnum::cases() as $enum) {
            yield $enum->value => ['enum' => $enum, 'value' => $enum->value];
        }
    }

    /**
     * @dataProvider provideChoices
     * @param $choices
     * @return void
     */
    public function testChoices($choices)
    {
        $this->assertEquals($choices, BackedEnum::easyAdminChoices());
        $this->assertEquals($choices, BackedEnum::formChoices());
    }

    public function provideChoices()
    {
        yield 'choices' => [['Value A' => 'a', 'Value B' => 'b']];
    }

    /**
     * @dataProvider provideAll
     * @param $enum
     * @param $value
     * @return void
     */
    public function testNormalizeToValueSuccess($enum, $value)
    {
        $this->assertEquals($value, BackedEnum::normalizeToValue($value));
        $this->assertEquals($value, BackedEnum::normalizeToValue($enum));
    }

    public function testNormalizeToValueFailure()
    {
        $this->expectException(ValueError::class);
        BackedEnum::normalizeToValue('abc123');
    }

    public function testNormalizeToValueFailureWrongEnum()
    {
        $this->expectException(ValueError::class);
        BackedEnum::normalizeToValue(LabelsEnum::userChanged);
    }

    /**
     * @dataProvider provideAll
     * @param $enum
     * @param $value
     * @return void
     */
    public function testNormalizeToEnumSuccess($enum, $value)
    {
        $this->assertEquals($enum, BackedEnum::normalizeToEnum($value));
        $this->assertEquals($enum, BackedEnum::normalizeToEnum($enum));
    }

    public function testNormalizeToEnumFailure()
    {
        $this->expectException(ValueError::class);
        BackedEnum::normalizeToEnum('abc123');
    }

    /**
     * @dataProvider provideAll
     * @param $enum
     * @param $value
     * @return void
     */
    public function testRandom($enum, $value)
    {
        $this->assertInstanceOf(\UnitEnum::class, BackedEnum::random());
    }
}
