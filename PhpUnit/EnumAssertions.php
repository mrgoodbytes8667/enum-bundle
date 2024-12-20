<?php

namespace Bytes\EnumSerializerBundle\PhpUnit;

use BackedEnum;
use BadMethodCallException;
use InvalidArgumentException;
use PHPUnit\Framework\Assert as PHPUnit;
use TypeError;

abstract class EnumAssertions
{
    /**
     * Checks if actual is a value of the given enum class name.
     *
     * @psalm-param class-string<BackedEnum> $enum
     *
     * @param string|mixed $actual
     */
    public static function assertIsEnumValue(string $enum, $actual, ?string $message = null): void
    {
        if (!is_subclass_of($enum, BackedEnum::class)) {
            throw new InvalidArgumentException(sprintf('The `$enum` argument has to be a FQCN to an `%s` class', BackedEnum::class));
        }

        PHPUnit::assertContains(
            $actual,
            forward_static_call([$enum, 'toValues']),
            $message ?? ''
        );
    }

    /**
     * Checks if actual is a label of the given enum class name.
     *
     * @psalm-param class-string<BackedEnum> $enum
     *
     * @param string|mixed $actual
     */
    public static function assertIsEnumLabel(string $enum, $actual, ?string $message = null): void
    {
        if (!is_subclass_of($enum, BackedEnum::class)) {
            throw new InvalidArgumentException(sprintf('The `$enum` argument has to be a FQCN to an `%s` class', BackedEnum::class));
        }

        PHPUnit::assertContains(
            $actual,
            forward_static_call([$enum, 'toLabels']),
            $message ?? ''
        );
    }

    /**
     * Checks if actual (after being transformed to enum) equals expected.
     *
     * @param BackedEnum|string|int|mixed $actual
     */
    public static function assertEqualsEnum(BackedEnum $expected, $actual, ?string $message = null): void
    {
        try {
            $enum = static::asEnum($actual, $expected);

            PHPUnit::assertTrue(
                $expected->equals($enum),
                $message ?? ''
            );
        } catch (TypeError $ex) {
            PHPUnit::assertTrue(false, $ex->getMessage());
        } catch (BadMethodCallException $ex) {
            PHPUnit::assertTrue(false, $ex->getMessage());
        }
    }

    /**
     * @param int|string|BackedEnum $value
     *
     * @throws TypeError
     * @throws BadMethodCallException
     *
     * @see \BackedEnum::make()
     */
    protected static function asEnum($value, BackedEnum $enum): BackedEnum
    {
        if ($value instanceof BackedEnum) {
            return $value;
        }

        return forward_static_call(
            [get_class($enum), 'from'],
            $value
        );
    }

    /**
     * Checks if actual equals expected.
     *
     * @param BackedEnum|mixed $actual
     */
    public static function assertSameEnum(BackedEnum $expected, $actual, ?string $message = null): void
    {
        static::assertIsEnum($actual);

        PHPUnit::assertTrue(
            $expected->equals($actual),
            $message ?? ''
        );
    }

    /**
     * Checks if actual extends \BackedEnum::class.
     *
     * @param BackedEnum|mixed $actual
     */
    public static function assertIsEnum($actual, ?string $message = null): void
    {
        PHPUnit::assertInstanceOf(
            BackedEnum::class,
            $actual,
            $message ?? ''
        );
    }

    /**
     * Checks if actual equals the value of expected.
     *
     * @param string|int|mixed $actual
     */
    public static function assertSameEnumValue(BackedEnum $expected, $actual, ?string $message = null): void
    {
        PHPUnit::assertSame(
            $expected->value,
            $actual,
            $message ?? ''
        );
    }
}
