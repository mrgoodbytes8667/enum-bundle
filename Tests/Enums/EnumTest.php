<?php

namespace Bytes\EnumSerializerBundle\Tests\Enums;

use Bytes\EnumSerializerBundle\Tests\Fixtures\BackedEnum;
use PHPUnit\Framework\TestCase;

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
}