<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Internal\TentativeType;
use JsonSerializable;

enum LabelsEnum: string implements JsonSerializable
{
    use BackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
}
