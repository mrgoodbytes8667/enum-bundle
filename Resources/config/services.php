<?php


namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use Bytes\EnumBundle\Serializer\Normalizer\EnumNormalizer;

/**
 * @param ContainerConfigurator $container
 */
return static function (ContainerConfigurator $container) {

    $services = $container->services();

    $services->set('bytesenumbundle.enumnormalizer', EnumNormalizer::class)
        ->tag('serializer.normalizer')
        ->args([service('serializer.normalizer.object')]);

};