<?php

namespace Bytes\EnumSerializerBundle\Enums;

use Symfony\Contracts\Translation\TranslatableInterface;

interface EnumTranslatableInterface extends TranslatableInterface
{
    public function transKey(): string;
}
