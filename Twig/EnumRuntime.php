<?php

namespace Bytes\EnumSerializerBundle\Twig;

use Bytes\EnumSerializerBundle\Enums\FormChoiceEnumInterface;
use Twig\Extension\RuntimeExtensionInterface;

class EnumRuntime implements RuntimeExtensionInterface
{
    /**
     * @param class-string<FormChoiceEnumInterface> $class
     *
     * @return string
     */
    public static function getFormLabel(string|int|null $value, string $class)
    {
        if (!is_null($value)) {
            /** @var FormChoiceEnumInterface|null $instance */
            $instance = $class::tryFrom($value);
            if (!is_null($instance)) {
                return $instance::getFormChoiceKey($instance);
            }
        }

        return '';
    }
}
