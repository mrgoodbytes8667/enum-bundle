# enum-serializer-bundle
[![Packagist Version](https://img.shields.io/packagist/v/mrgoodbytes8667/enum-serializer-bundle?logo=packagist&logoColor=FFF&style=flat)](https://packagist.org/packages/mrgoodbytes8667/enum-serializer-bundle)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/mrgoodbytes8667/enum-serializer-bundle?logo=php&logoColor=FFF&style=flat)](https://packagist.org/packages/mrgoodbytes8667/enum-serializer-bundle)
![Symfony Versions Supported](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fsymfony%2F%255E6.2&logoColor=FFF&style=flat)
![Symfony Versions Tested](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fsymfony-test%2F%253E%253D6.2%2520%253C6.4&logoColor=FFF&style=flat)
![Symfony LTS Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Flts%2F%255E6.2&logoColor=FFF&style=flat)
![Symfony Stable Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fstable%2F%255E6.2&logoColor=FFF&style=flat)
![Symfony Dev Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fdev%2F%255E6.2&logoColor=FFF&style=flat)
![Packagist License](https://img.shields.io/packagist/l/mrgoodbytes8667/enum-serializer-bundle?style=flat)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/mrgoodbytes8667/enum-serializer-bundle/release.yml?label=stable&logo=github&logoColor=FFF&style=flat)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/mrgoodbytes8667/enum-serializer-bundle/run-tests.yml?logo=github&logoColor=FFF&style=flat)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/mrgoodbytes8667/enum-serializer-bundle/run-tests-by-version.yml?logo=github&logoColor=FFF&style=flat)
[![codecov](https://img.shields.io/codecov/c/github/mrgoodbytes8667/enum-serializer-bundle/4.1?logo=codecov&logoColor=FFF&style=flat)](https://codecov.io/gh/mrgoodbytes8667/enum-serializer-bundle)  
A bundle to provide some helper methods for PHP 8.1+ enums inspired by [spatie/enum](https://github.com/spatie/enum)

## Upgrading to 4.0 from 3.x
- Replace any usages of `Bytes\EnumSerializerBundle\Request\EnumParameterConverter` with ValueResolvers. See https://symfony.com/doc/current/controller/value_resolver.html

## Upgrading to 3.0 from 2.x
- Replace the deprecated calls to `easyAdminChoices()` and `formChoices()` with `provideFormChoices()`.
- Upgrade any overridden versions of `provideFormChoices()`, `getFormChoiceKey()`, and `getFormChoiceValue()` from `protected` to `public`.

## Upgrading to 2.0
Change all classes that extend `Bytes\EnumSerializerBundle\Enums\Enum` to be string backed enums, using the new
`Bytes\EnumSerializerBundle\Enums\StringBackedEnumTrait` trait and implementing the new
`Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface` interface.

- `Bytes\EnumSerializerBundle\Enums\StringBackedEnumTrait` provides the previous `Enum` class methods that are still relevant
and needed with the switch to enums, including a `jsonSerializable()` method to keep serialization consistent.
- `Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface` must be implemented (or `\JsonSerializable`) in order to have
the serializer properly return label/value as it did prior to 2.0.
- Note: `Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface` extends both
`Bytes\EnumSerializerBundle\Enums\EasyAdminChoiceEnumInterface` and
`Bytes\EnumSerializerBundle\Enums\FormChoiceEnumInterface`, which both automatically provide EasyAdminBundle and Symfony 
form compatible choice methods and are easily overloadable.

### Before

```php
<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Spatie\Enum\Enum;

/**
 * @method static self streamChanged()
 * @method static self userChanged()
 */
class ValuesEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'streamChanged' => 'stream',
            'userChanged' => 'user',
        ];
    }
}
```

### After

```php
<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\StringBackedEnumTrait;

enum ValuesEnum: string implements StringBackedEnumInterface
{
    use StringBackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
}
```

#### With Optional Deprecated Replacement for PHPStorm

```php
<?php


namespace Bytes\EnumSerializerBundle\Tests\Fixtures;


use Bytes\EnumSerializerBundle\Enums\StringBackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\StringBackedEnumTrait;
use JetBrains\PhpStorm\Deprecated;

enum ValuesEnum: string implements StringBackedEnumInterface
{
    use StringBackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
    
    #[Deprecated(reason: 'since 1.7.0, use "%name%" instead.', replacement: '%class%::%name%')]
    public static function streamChanged(): ValuesEnum
    {
        return ValuesEnum::streamChanged;
    }
    
    #[Deprecated(reason: 'since 1.7.0, use "%name%" instead.', replacement: '%class%::%name%')]
    public static function userChanged(): ValuesEnum
    {
        return ValuesEnum::userChanged;
    }
}
```

Note that the automated replacement will not remove the trailing `()` following the function

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require mrgoodbytes8667/enum-serializer-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mrgoodbytes8667/enum-serializer-bundle
```

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Bytes\EnumSerializerBundle\BytesEnumSerializerBundle::class => ['all' => true],
];
```

## License
Inspired by and based on the [spatie/enum](https://github.com/spatie/enum) package. 
