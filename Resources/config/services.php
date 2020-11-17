<?php


namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use Bytes\EnumSerializerBundle\Request\EnumParameterConverter;
use Bytes\EnumSerializerBundle\Serializer\Normalizer\EnumNormalizer;

/**
 * @param ContainerConfigurator $container
 */
return static function (ContainerConfigurator $container) {

    $services = $container->services();

    $services->set('bytesenumserializerbundle.enumnormalizer', EnumNormalizer::class)
        ->tag('serializer.normalizer')
        ->args([service('serializer.normalizer.object')]);

    $services->set('bytesenumserializerbundle.enum_parameter_converter', EnumParameterConverter::class)
        ->tag('request.param_converter', [
            'converter' => 'bytes_enum'
        ]);

};