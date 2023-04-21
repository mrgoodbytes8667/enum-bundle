<?php

namespace Bytes\EnumSerializerBundle\Enums;

use ReflectionEnum;
use UnitEnum;
use ValueError;

trait UnitEnumTrait
{
    /**
     * @return UnitEnum
     */
    public static function random(): UnitEnum
    {
        $random = array_rand(static::cases());

        return static::cases()[$random];
    }

    public static function fromName(string $name): static
    {
        $enum = static::tryFromName($name);
        if (is_null($enum)) {
            throw new ValueError(sprintf('No enum can be found with the name "%s".', $name));
        }

        return $enum;
    }

    public static function tryFromName(string $name): ?static
    {
        $reflection = new ReflectionEnum(static::class);

        return $reflection->hasCase($name) ? $reflection->getCase($name)->getValue() : null;
    }
}
