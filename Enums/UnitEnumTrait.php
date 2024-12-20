<?php

namespace Bytes\EnumSerializerBundle\Enums;

use Illuminate\Support\Arr;
use ReflectionAttribute;
use ReflectionClassConstant;
use ReflectionEnum;
use UnitEnum;
use ValueError;

trait UnitEnumTrait
{
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

    /**
     * @param class-string $attributeClass
     *
     * @return mixed
     */
    private function getAttribute(string $attributeClass)
    {
        return Arr::first($this->getAttributes($attributeClass));
    }

    /**
     * @param class-string $attributeClass
     */
    private function getAttributes(string $attributeClass): array
    {
        $ref = new ReflectionClassConstant(static::class, $this->name);
        $classAttributes = $ref->getAttributes($attributeClass);

        if (0 === count($classAttributes)) {
            return [];
        }

        return array_map(function (ReflectionAttribute $attribute) {
            return $attribute->newInstance();
        }, $classAttributes);
    }
}
