<?php

namespace Bytes\EnumSerializerBundle\Tests\Twig;

use Bytes\EnumSerializerBundle\Tests\Fixtures\BackedEnum;
use Bytes\EnumSerializerBundle\Twig\EnumRuntime;
use PHPUnit\Framework\TestCase;

class EnumRuntimeTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetLabel()
    {
        $this->assertEquals(BackedEnum::getFormChoiceKey(BackedEnum::VALUE_A), EnumRuntime::getFormLabel('a', BackedEnum::class));
    }

    /**
     * @return void
     */
    public function testGetNullString()
    {
        $this->assertEmpty(EnumRuntime::getFormLabel(null, BackedEnum::class));
        $this->assertEmpty(EnumRuntime::getFormLabel('c', BackedEnum::class));
    }
}
