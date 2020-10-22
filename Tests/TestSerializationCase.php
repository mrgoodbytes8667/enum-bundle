<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Serializer\Normalizer\EnumNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UnwrappingDenormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class TestSerializationCase extends TestCase
{
    protected function createSerializer(bool $includeEnumNormalizer = true, bool $includeObjectNormalizer = true, array $prependNormalizers = [], array $appendNormalizers = [])
    {
        $objectNormalizer = new ObjectNormalizer();

        $encoders = [new JsonEncoder()];
        $normalizers = $this->getNormalizers($includeEnumNormalizer, $includeObjectNormalizer, array_merge($prependNormalizers, [new UnwrappingDenormalizer()]), $appendNormalizers);

        return new Serializer($normalizers, $encoders);
    }

    /**
     * @param bool $includeEnumNormalizer
     * @param bool $includeObjectNormalizer
     * @param array $prependNormalizers
     * @param array $appendNormalizers
     * @return array
     */
    protected function getNormalizers(bool $includeEnumNormalizer = true, bool $includeObjectNormalizer = true, array $prependNormalizers = [], array $appendNormalizers = [])
    {
        $normalizers = $prependNormalizers;
        if ($includeEnumNormalizer || $includeObjectNormalizer || !empty($appendNormalizers)) {
            $objectNormalizer = new ObjectNormalizer();
            if ($includeEnumNormalizer) {
                $normalizers[] = new EnumNormalizer($objectNormalizer);
            }
            foreach ($appendNormalizers as $normalizer) {
                $normalizers[] = $normalizer;
            }
            if ($includeObjectNormalizer) {
                $normalizers[] = $objectNormalizer;
            }
        }
        return $normalizers;
    }

    protected function buildFixtureResponse(string $value, string $label = null)
    {
        return json_encode([
            'label' => $label ?? $value,
            'value' => $value
        ]);
    }
}