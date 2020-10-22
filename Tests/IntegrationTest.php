<?php


namespace Bytes\EnumSerializerBundle\Tests;


use Bytes\EnumSerializerBundle\Serializer\Normalizer\EnumNormalizer;
use Bytes\EnumSerializerBundle\Tests\Fixtures\BothEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\LabelsEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\PlainEnum;
use Bytes\EnumSerializerBundle\Tests\Fixtures\ValuesEnum;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UnwrappingDenormalizer;
use Symfony\Component\Serializer\Serializer;

class IntegrationTest extends TestCase
{
    public function testPlainSerialization()
    {
        $serializer = $this->createSerializer();

        $output = $serializer->serialize(PlainEnum::channelCreate(), 'json');

        $this->assertEquals('{"value":"channelCreate"}', $output);
    }

    protected function createSerializer(bool $includeEnumNormalizer = true, bool $includeObjectNormalizer = true, array $prependNormalizers = [], array $appendNormalizers = [])
    {
        $objectNormalizer = new ObjectNormalizer();

        $encoders = [new JsonEncoder()];
        //$normalizers = [new UnwrappingDenormalizer(), new EnumNormalizer($objectNormalizer), $objectNormalizer];
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
    protected function getNormalizers(bool $includeEnumNormalizer = true, bool $includeObjectNormalizer = true, array $prependNormalizers = [], array $appendNormalizers = []) {
        $normalizers = $prependNormalizers;
        if($includeEnumNormalizer || $includeObjectNormalizer || !empty($appendNormalizers)) {
            $objectNormalizer = new ObjectNormalizer();
            if ($includeEnumNormalizer) {
                $normalizers[] = new EnumNormalizer($objectNormalizer);
            }
            foreach ($appendNormalizers as $normalizer)
            {
                $normalizers[] = $normalizer;
            }
            if ($includeObjectNormalizer) {
                $normalizers[] = $objectNormalizer;
            }
        }
        return $normalizers;
    }

    public function testValuesSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(ValuesEnum::streamChanged(), 'json');
        $this->assertEquals('{"value":"stream"}', $output);
    }

    public function testLabelsSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(LabelsEnum::streamChanged(), 'json');
        $this->assertEquals('{"value":"streamChanged"}', $output);
    }

    public function testBothSerialization()
    {
        $serializer = $this->createSerializer();
        $output = $serializer->serialize(BothEnum::streamChanged(), 'json');
        $this->assertEquals('{"value":"streamValue"}', $output);
    }

    /**
     * If this ever begins to fail, we won't need this bundle anymore!
     */
    public function testSpatieEnumWillNotSerializeAlone()
    {
        $serializer = $this->createSerializer(false, true);
        $output = $serializer->serialize(BothEnum::streamChanged(), 'json');
        $this->assertEquals('[]', $output);
    }
}