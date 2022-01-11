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
}