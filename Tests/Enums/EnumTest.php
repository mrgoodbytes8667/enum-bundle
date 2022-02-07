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
}