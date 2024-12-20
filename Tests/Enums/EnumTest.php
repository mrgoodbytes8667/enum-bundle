<?php

namespace Bytes\EnumSerializerBundle\Tests\Enums;

use Bytes\EnumSerializerBundle\PhpUnit\EnumAssertions;
use Bytes\EnumSerializerBundle\Tests\Fixtures\BackedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\BackedEnumWithAttributes;
use Bytes\EnumSerializerBundle\Tests\Fixtures\IntBackedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\LabelsEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\SampleAttribute;
use Bytes\EnumSerializerBundle\Tests\Fixtures\SampleRepeatableAttribute;
use Bytes\EnumSerializerBundle\Tests\Fixtures\UnbackedEnum;
use Generator;
use PHPUnit\Framework\TestCase;
use TypeError;
use UnitEnum;
use ValueError;

class EnumTest extends TestCase
{
    /**
     * @return Generator
     */
    public static function provideNormalizeToEnumsString()
    {
        yield ['input' => ['a'], 'expected' => [BackedEnum::VALUE_A]];
        yield ['input' => [BackedEnum::VALUE_A], 'expected' => [BackedEnum::VALUE_A]];
        yield ['input' => ['a', 'b', BackedEnum::VALUE_A], 'expected' => [BackedEnum::VALUE_A, BackedEnum::VALUE_B, BackedEnum::VALUE_A]];
        yield ['input' => ['a', 'b', null, BackedEnum::VALUE_A], 'expected' => [BackedEnum::VALUE_A, BackedEnum::VALUE_B, BackedEnum::VALUE_A]];
        yield ['input' => [BackedEnum::VALUE_A, ['a', 'b', BackedEnum::VALUE_A], BackedEnum::VALUE_B], 'expected' => [BackedEnum::VALUE_A, BackedEnum::VALUE_A, BackedEnum::VALUE_B, BackedEnum::VALUE_A, BackedEnum::VALUE_B]];
        yield ['input' => [], 'expected' => []];
        yield ['input' => [null], 'expected' => []];
        yield ['input' => ['VALUE_A'], 'expected' => [BackedEnum::VALUE_A]];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToEnumsStringInvalidValue()
    {
        yield ['input' => ['c'], 'expected' => []];
        yield ['input' => ['a', 'c', BackedEnum::VALUE_A], 'expected' => [BackedEnum::VALUE_A, BackedEnum::VALUE_A]];
        yield ['input' => ['a', 'c', null, BackedEnum::VALUE_A], 'expected' => [BackedEnum::VALUE_A, BackedEnum::VALUE_A]];
        yield ['input' => [BackedEnum::VALUE_A, ['a', 'c', BackedEnum::VALUE_A], BackedEnum::VALUE_B], 'expected' => [BackedEnum::VALUE_A, BackedEnum::VALUE_A, BackedEnum::VALUE_A, BackedEnum::VALUE_B]];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToValuesString()
    {
        yield ['input' => ['a'], 'expected' => ['a']];
        yield ['input' => [BackedEnum::VALUE_A], 'expected' => ['a']];
        yield ['input' => ['a', 'b', BackedEnum::VALUE_A], 'expected' => ['a', 'b', 'a']];
        yield ['input' => ['a', 'b', null, BackedEnum::VALUE_A], 'expected' => ['a', 'b', 'a']];
        yield ['input' => [BackedEnum::VALUE_A, ['a', 'b', BackedEnum::VALUE_A], BackedEnum::VALUE_B], 'expected' => ['a', 'a', 'b', 'a', 'b']];
        yield ['input' => [], 'expected' => []];
        yield ['input' => [null], 'expected' => []];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToValuesStringInvalidValue()
    {
        yield ['input' => ['c'], 'expected' => []];
        yield ['input' => ['a', 'c', BackedEnum::VALUE_A], 'expected' => ['a', 'a']];
        yield ['input' => ['a', 'c', null, BackedEnum::VALUE_A], 'expected' => ['a', 'a']];
        yield ['input' => [BackedEnum::VALUE_A, ['a', 'c', BackedEnum::VALUE_A], BackedEnum::VALUE_B], 'expected' => ['a', 'a', 'a', 'b']];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToEnumsInt()
    {
        yield ['input' => [0], 'expected' => [IntBackedEnum::zero]];
        yield ['input' => [IntBackedEnum::zero], 'expected' => [IntBackedEnum::zero]];
        yield ['input' => [0, 1, IntBackedEnum::zero], 'expected' => [IntBackedEnum::zero, IntBackedEnum::one, IntBackedEnum::zero]];
        yield ['input' => [0, 1, null, IntBackedEnum::zero], 'expected' => [IntBackedEnum::zero, IntBackedEnum::one, IntBackedEnum::zero]];
        yield ['input' => [IntBackedEnum::zero, [0, 1, IntBackedEnum::zero], IntBackedEnum::one], 'expected' => [IntBackedEnum::zero, IntBackedEnum::zero, IntBackedEnum::one, IntBackedEnum::zero, IntBackedEnum::one]];
        yield ['input' => [], 'expected' => []];
        yield ['input' => [null], 'expected' => []];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToEnumsIntInvalidValue()
    {
        yield ['input' => [999], 'expected' => []];
        yield ['input' => [0, 999, IntBackedEnum::zero], 'expected' => [IntBackedEnum::zero, IntBackedEnum::zero]];
        yield ['input' => [0, 999, null, IntBackedEnum::zero], 'expected' => [IntBackedEnum::zero, IntBackedEnum::zero]];
        yield ['input' => [IntBackedEnum::zero, [0, 999, IntBackedEnum::zero], IntBackedEnum::one], 'expected' => [IntBackedEnum::zero, IntBackedEnum::zero, IntBackedEnum::zero, IntBackedEnum::one]];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToValuesInt()
    {
        yield ['input' => [0], 'expected' => [0]];
        yield ['input' => ['0'], 'expected' => [0]];
        yield ['input' => [IntBackedEnum::zero], 'expected' => [0]];
        yield ['input' => [0, 1, IntBackedEnum::zero], 'expected' => [0, 1, 0]];
        yield ['input' => [0, 1, null, IntBackedEnum::zero], 'expected' => [0, 1, 0]];
        yield ['input' => [IntBackedEnum::zero, [0, 1, IntBackedEnum::zero], IntBackedEnum::one], 'expected' => [0, 0, 1, 0, 1]];
        yield ['input' => [], 'expected' => []];
        yield ['input' => [null], 'expected' => []];
    }

    /**
     * @return Generator
     */
    public static function provideNormalizeToValuesIntInvalidValue()
    {
        yield ['input' => [999], 'expected' => []];
        yield ['input' => [0, 999, IntBackedEnum::zero, '999'], 'expected' => [0, 0]];
        yield ['input' => [0, 999, null, IntBackedEnum::zero], 'expected' => [0, 0]];
        yield ['input' => [IntBackedEnum::zero, [0, 999, IntBackedEnum::zero], IntBackedEnum::one], 'expected' => [0, 0, 0, 1]];
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

    /**
     * @return void
     */
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
     * @return Generator
     */
    public function provideAllInt(): Generator
    {
        foreach (IntBackedEnum::cases() as $enum) {
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
        $this->assertEquals($choices, BackedEnum::provideFormChoices());
    }

    /**
     * @return Generator
     */
    public function provideChoices()
    {
        yield 'choices' => [['Value A' => 'a', 'Value B' => 'b']];
    }

    /**
     * @dataProvider providePartialChoices
     * @param array<string, string> $manualValue
     * @param array<string, BackedEnum> $manualEnum
     * @param BackedEnum[]|null $enum
     * @return void
     */
    public function testPartialChoices($manualValue, $manualEnum, $enum): void
    {
        $this->assertEquals($manualValue, BackedEnum::provideFormChoices($enum));
    }

    /**
     * @return Generator
     */
    public function providePartialChoices(): Generator
    {
        yield 'A' => ['manualValue' => ['Value A' => 'a'], 'manualEnum' => ['Value A' => BackedEnum::VALUE_A], 'enum' => [BackedEnum::VALUE_A]];
        yield 'B' => ['manualValue' => ['Value B' => 'b'], 'manualEnum' => ['Value B' => BackedEnum::VALUE_B], 'enum' => [BackedEnum::VALUE_B]];
        yield 'All' => ['manualValue' => ['Value A' => 'a', 'Value B' => 'b'], 'manualEnum' => ['Value A' => BackedEnum::VALUE_A, 'Value B' => BackedEnum::VALUE_B], 'enum' => BackedEnum::cases()];
        yield 'null' => ['manualValue' => ['Value A' => 'a', 'Value B' => 'b'], 'manualEnum' => ['Value A' => BackedEnum::VALUE_A, 'Value B' => BackedEnum::VALUE_B], 'enum' => null];
        yield 'empty' => ['manualValue' => [], 'manualEnum' => [], 'enum' => []];
    }

    /**
     * @dataProvider provideEnumChoices
     * @param $choices
     * @return void
     */
    public function testEnumChoices($choices)
    {
        $this->assertEquals($choices, BackedEnum::provideFormEnums());
    }

    /**
     * @return Generator
     */
    public function provideEnumChoices()
    {
        yield 'choices' => [['Value A' => BackedEnum::VALUE_A, 'Value B' => BackedEnum::VALUE_B]];
    }

    /**
     * @dataProvider providePartialChoices
     * @param array<string, string> $manualValue
     * @param array<string, BackedEnum> $manualEnum
     * @param BackedEnum[]|null $enum
     * @return void
     */
    public function testPartialEnumChoices($manualValue, $manualEnum, $enum)
    {
        $this->assertEquals($manualEnum, BackedEnum::provideFormEnums($enum));
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

    /**
     * @return void
     */
    public function testNormalizeToValueFailure()
    {
        $this->expectException(ValueError::class);
        BackedEnum::normalizeToValue('abc123');
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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
    public function testTryNormalizeToValueSuccess($enum, $value)
    {
        $this->assertEquals($value, BackedEnum::tryNormalizeToValue($value));
        $this->assertEquals($value, BackedEnum::tryNormalizeToValue($enum));
    }

    /**
     * @return void
     */
    public function testTryNormalizeToValueFailure()
    {
        $this->assertNull(BackedEnum::tryNormalizeToValue('abc123'));
    }

    /**
     * @return void
     */
    public function testTryNormalizeToValueFailureWrongEnum()
    {
        $this->assertNull(BackedEnum::tryNormalizeToValue(LabelsEnum::userChanged));
    }

    /**
     * @dataProvider provideAll
     * @param $enum
     * @param $value
     * @return void
     */
    public function testTryNormalizeToEnumSuccess($enum, $value)
    {
        $this->assertEquals($enum, BackedEnum::tryNormalizeToEnum($value));
        $this->assertEquals($enum, BackedEnum::tryNormalizeToEnum($enum));
        self::assertEquals($enum, BackedEnum::tryNormalizeToEnum($enum->name));
    }

    /**
     * @return void
     */
    public function testTryNormalizeToEnumFailure()
    {
        $this->assertNull(BackedEnum::tryNormalizeToEnum('abc123'));
    }

    /**
     * @dataProvider provideAll
     * @param $enum
     * @param $value
     * @return void
     */
    public function testRandom($enum, $value)
    {
        $this->assertInstanceOf(UnitEnum::class, BackedEnum::random());
    }

    /**
     * @dataProvider provideAllInt
     * @param $enum
     * @param $value
     * @return void
     */
    public function testNormalizeToIntEnumSuccess($enum, $value)
    {
        $this->assertEquals($enum, IntBackedEnum::normalizeToEnum($value));
        $this->assertEquals($enum, IntBackedEnum::normalizeToEnum($enum));
    }

    /**
     * @return void
     */
    public function testNormalizeToIntEnumFailure()
    {
        $this->expectException(ValueError::class);
        IntBackedEnum::normalizeToEnum(9);
    }

    /**
     * @dataProvider provideAllInt
     * @param $enum
     * @param $value
     * @return void
     */
    public function testNormalizeToIntValueSuccess($enum, $value)
    {
        $this->assertEquals($value, IntBackedEnum::normalizeToValue($value));
        $this->assertEquals($value, IntBackedEnum::normalizeToValue($enum));
    }

    /**
     * @return void
     */
    public function testNormalizeToIntValueFailure()
    {
        $this->expectException(ValueError::class);
        IntBackedEnum::normalizeToValue(9);
    }

    /**
     * @return void
     */
    public function testNormalizeToIntValueFailureWrongEnum()
    {
        $this->expectException(ValueError::class);
        IntBackedEnum::normalizeToValue(LabelsEnum::userChanged);
    }

    /**
     * @dataProvider provideAllInt
     * @param $enum
     * @param $value
     * @return void
     */
    public function testTryNormalizeToIntEnumSuccess($enum, $value)
    {
        $this->assertEquals($enum, IntBackedEnum::tryNormalizeToEnum($value));
        $this->assertEquals($enum, IntBackedEnum::tryNormalizeToEnum($enum));
    }

    /**
     * @return void
     */
    public function testTryNormalizeToIntEnumFailure()
    {
        $this->assertNull(IntBackedEnum::tryNormalizeToEnum(9));
    }

    /**
     * @dataProvider provideAllInt
     * @param $enum
     * @param $value
     * @return void
     */
    public function testTryNormalizeToIntValueSuccess($enum, $value)
    {
        $this->assertEquals($value, IntBackedEnum::tryNormalizeToValue($value));
        $this->assertEquals($value, IntBackedEnum::tryNormalizeToValue($enum));
    }

    /**
     * @return void
     */
    public function testTryNormalizeToIntValueFailure()
    {
        $this->assertNull(IntBackedEnum::tryNormalizeToValue(9));
    }

    /**
     * @return void
     */
    public function testTryNormalizeToIntValueFailureWrongEnum()
    {
        $this->assertNull(IntBackedEnum::tryNormalizeToValue(LabelsEnum::userChanged));
    }

    /**
     * @dataProvider provideNormalizeToEnumsString
     * @param $input
     * @param $expected
     * @return void
     */
    public function testNormalizeToEnumsString($input, $expected)
    {
        self::assertEquals($expected, BackedEnum::normalizeToEnums(...$input));
    }

    /**
     * @dataProvider provideNormalizeToEnumsStringInvalidValue
     * @param $input
     * @return void
     */
    public function testNormalizeToEnumsStringInvalidValue($input)
    {
        self::expectException(ValueError::class);
        BackedEnum::normalizeToEnums(...$input);
    }

    /**
     * @dataProvider provideNormalizeToEnumsString
     * @dataProvider provideNormalizeToEnumsStringInvalidValue
     * @param $input
     * @param $expected
     * @return void
     */
    public function testTryNormalizeToEnumsString($input, $expected)
    {
        self::assertEquals($expected, BackedEnum::tryNormalizeToEnums(...$input));
    }

    /**
     * @dataProvider provideNormalizeToValuesString
     * @param $input
     * @param $expected
     * @return void
     */
    public function testNormalizeToValuesString($input, $expected)
    {
        self::assertEquals($expected, BackedEnum::normalizeToValues(...$input));
    }

    /**
     * @dataProvider provideNormalizeToValuesStringInvalidValue
     * @param $input
     * @return void
     */
    public function testNormalizeToValuesStringInvalidValue($input)
    {
        self::expectException(ValueError::class);
        BackedEnum::normalizeToValues(...$input);
    }

    /**
     * @dataProvider provideNormalizeToValuesString
     * @dataProvider provideNormalizeToValuesStringInvalidValue
     * @param $input
     * @param $expected
     * @return void
     */
    public function testTryNormalizeToValuesString($input, $expected)
    {
        self::assertEquals($expected, BackedEnum::tryNormalizeToValues(...$input));
    }

    /**
     * @dataProvider provideNormalizeToEnumsInt
     * @param $input
     * @param $expected
     * @return void
     */
    public function testNormalizeToEnumsInt($input, $expected)
    {
        self::assertEquals($expected, IntBackedEnum::normalizeToEnums(...$input));
    }

    /**
     * @dataProvider provideNormalizeToEnumsIntInvalidValue
     * @param $input
     * @return void
     */
    public function testNormalizeToEnumsIntInvalidValue($input)
    {
        self::expectException(ValueError::class);
        IntBackedEnum::normalizeToEnums(...$input);
    }

    /**
     * @dataProvider provideNormalizeToEnumsInt
     * @dataProvider provideNormalizeToEnumsIntInvalidValue
     * @param $input
     * @param $expected
     * @return void
     */
    public function testTryNormalizeToEnumsInt($input, $expected)
    {
        self::assertEquals($expected, IntBackedEnum::tryNormalizeToEnums(...$input));
    }

    /**
     * @dataProvider provideNormalizeToValuesInt
     * @param $input
     * @param $expected
     * @return void
     */
    public function testNormalizeToValuesInt($input, $expected)
    {
        self::assertEquals($expected, IntBackedEnum::normalizeToValues(...$input));
    }

    /**
     * @dataProvider provideNormalizeToValuesIntInvalidValue
     * @param $input
     * @return void
     */
    public function testNormalizeToValuesIntInvalidValue($input)
    {
        self::expectException(ValueError::class);
        IntBackedEnum::normalizeToValues(...$input);
    }

    /**
     * @return void
     */
    public function testNormalizeToValuesIntInvalidType()
    {
        self::expectException(TypeError::class);
        IntBackedEnum::normalizeToValues(['c']);
    }

    /**
     * @dataProvider provideNormalizeToValuesInt
     * @dataProvider provideNormalizeToValuesIntInvalidValue
     * @param $input
     * @param $expected
     * @return void
     */
    public function testTryNormalizeToValuesInt($input, $expected)
    {
        self::assertEquals($expected, IntBackedEnum::tryNormalizeToValues(...$input));
    }

    /**
     * @return void
     */
    public function testNormalizeToValuesNull()
    {
        self::assertEquals([], BackedEnum::normalizeToValues());
        self::assertEquals([], BackedEnum::normalizeToValues(null));
        self::assertEquals([], BackedEnum::tryNormalizeToValues());
        self::assertEquals([], BackedEnum::tryNormalizeToValues(null));
        self::assertEquals([], IntBackedEnum::normalizeToValues());
        self::assertEquals([], IntBackedEnum::normalizeToValues(null));
        self::assertEquals([], IntBackedEnum::tryNormalizeToValues());
        self::assertEquals([], IntBackedEnum::tryNormalizeToValues(null));
    }

    public function testFromName() {
        self::assertEquals(BackedEnum::VALUE_A, BackedEnum::fromName('VALUE_A'));
        self::assertEquals(BackedEnum::VALUE_B, BackedEnum::fromName('VALUE_B'));
        self::assertEquals(UnbackedEnum::A, UnbackedEnum::fromName('A'));
    }

    public function testTryFromName() {
        self::assertEquals(BackedEnum::VALUE_A, BackedEnum::tryFromName('VALUE_A'));
        self::assertEquals(BackedEnum::VALUE_B, BackedEnum::tryFromName('VALUE_B'));
        self::assertEquals(UnbackedEnum::A,   UnbackedEnum::tryFromName('A'));
        self::assertNull(BackedEnum::tryFromName('VALUE_C'));
        self::assertNull(UnbackedEnum::tryFromName('VALUE_C'));
    }

    public function testGetAttribute()
    {
        $attribute = BackedEnumWithAttributes::VALUE_A->getSampleAttribute();
        $attributes = BackedEnumWithAttributes::VALUE_A->getSampleAttributes();
        $attributeRepeatable = BackedEnumWithAttributes::VALUE_A->getSampleRepeatableAttribute();
        $attributesRepeatable = BackedEnumWithAttributes::VALUE_A->getSampleRepeatableAttributes();

        self::assertInstanceOf(SampleAttribute::class, $attribute);
        self::assertCount(1, $attributes);
        self::assertNull($attributeRepeatable);
        self::assertCount(0, $attributesRepeatable);
        self::assertEquals('The value is a', $attribute->getValue());
        self::assertEquals($attribute->getValue(), $attributes[0]->getValue());


        $attribute = BackedEnumWithAttributes::VALUE_B->getSampleAttribute();
        $attributes = BackedEnumWithAttributes::VALUE_B->getSampleAttributes();
        $attributeRepeatable = BackedEnumWithAttributes::VALUE_B->getSampleRepeatableAttribute();
        $attributesRepeatable = BackedEnumWithAttributes::VALUE_B->getSampleRepeatableAttributes();

        self::assertNull($attribute);
        self::assertCount(0, $attributes);
        self::assertInstanceOf(SampleRepeatableAttribute::class, $attributeRepeatable);
        self::assertCount(2, $attributesRepeatable);
        self::assertEquals('The value is b', $attributeRepeatable->getValue());
        $value = array_shift($attributesRepeatable);
        self::assertEquals('The value is b', $value->getValue());
        $value = array_shift($attributesRepeatable);
        self::assertEquals('The value is still b', $value->getValue());
    }

    public function testTransKey()
    {
        self::assertSame('enums.backed_enum.VALUE_A', BackedEnum::VALUE_A->transKey());
    }
}
