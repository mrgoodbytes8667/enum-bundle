<?php


namespace Bytes\EnumSerializerBundle\Request;


use BackedEnum;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EnumParameterConverter
 * @package Bytes\EnumSerializerBundle\Request
 *
 * @link https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
 *
 * @deprecated since 3.2.2, replace with a ValueResolver: https://symfony.com/doc/current/controller/value_resolver.html
 */
class EnumParameterConverter implements ParamConverterInterface
{
    /**
     * Stores the object in the request.
     *
     * @param Request $request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $param = $configuration->getName();

        if (!$request->attributes->has($param)) {
            return false;
        }

        $value = $request->attributes->get($param);

        if (!$value && $configuration->isOptional()) {
            $request->attributes->set($param, null);

            return true;
        }

        $class = $configuration->getClass();

        $f = new $class($value);

        $request->attributes->set($param, $f);

        return true;
    }

    /**
     * Checks if the object is supported.
     *
     * @param ParamConverter $configuration
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return is_subclass_of($configuration->getClass(), BackedEnum::class);
    }
}
