<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;
use Bytes\EnumSerializerBundle\Enums\EasyAdminChoiceEnumInterface;
use JsonSerializable;

enum LabelsEnum: string implements EasyAdminChoiceEnumInterface, JsonSerializable
{
    use BackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
}
