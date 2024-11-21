<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Tests\Fixtures\BackedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\IntBackedEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainInheritedEnum;
use PHPUnit\Framework\TestCase;

class ChildTest extends TestCase
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

        $this->assertFalse(PlainInheritedEnum::isValid(-1));

        $this->assertFalse(IntBackedEnum::isValid('abc123'));
        $this->assertFalse(BackedEnum::isValid(-1));
    }
}