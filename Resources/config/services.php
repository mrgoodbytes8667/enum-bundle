<?php


namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use Bytes\EnumSerializerBundle\Serializer\Normalizer\EnumNormalizer;
use Bytes\EnumSerializerBundle\Twig\EnumExtension;
use Bytes\EnumSerializerBundle\Twig\EnumRuntime;

/**
 * @param ContainerConfigurator $container
 */
return static function (ContainerConfigurator $container) {

    $services = $container->services();

    $services->set('bytesenumserializerbundle.enumnormalizer', EnumNormalizer::class)
        ->tag('serializer.normalizer')
        ->args([service('serializer.normalizer.object')]);

    $services->set('bytesenumserializerbundle.enum_extension', EnumExtension::class)
        ->tag('twig.extension');

    $services->set('bytesenumserializerbundle.enum_runtime', EnumRuntime::class)
        ->tag('twig.runtime');

};
