# enum-serializer-bundle
[![Packagist Version](https://img.shields.io/packagist/v/mrgoodbytes8667/enum-serializer-bundle?logo=packagist&logoColor=FFF&style=flat)](https://packagist.org/packages/mrgoodbytes8667/enum-serializer-bundle)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/mrgoodbytes8667/enum-serializer-bundle?logo=php&logoColor=FFF&style=flat)](https://packagist.org/packages/mrgoodbytes8667/enum-serializer-bundle)
![Symfony Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.goodbytes.live%2Fshield%2Fsymfony%2F%255E5.2%2520%257C%2520%255E6.0&logoColor=FFF&style=flat)
![Packagist License](https://img.shields.io/packagist/l/mrgoodbytes8667/enum-serializer-bundle?logo=creative-commons&logoColor=FFF&style=flat)  
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/mrgoodbytes8667/enum-serializer-bundle/release?label=stable&logo=github&logoColor=FFF&style=flat)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/mrgoodbytes8667/enum-serializer-bundle/tests?logo=github&logoColor=FFF&style=flat)
[![codecov](https://img.shields.io/codecov/c/github/mrgoodbytes8667/enum-serializer-bundle?logo=codecov&logoColor=FFF&style=flat)](https://codecov.io/gh/mrgoodbytes8667/enum-serializer-bundle)  
A bundle to provide some helper methods for PHP 8.1+ enums

## Upgrading to 2.0
Change all classes that extend `Bytes\EnumSerializerBundle\Enums\Enum` to be string backed enums, using the new
`Bytes\EnumSerializerBundle\Enums\BackedEnumTrait` trait and implementing the new
`Bytes\EnumSerializerBundle\Enums\BackedEnumInterface` interface.

- `Bytes\EnumSerializerBundle\Enums\BackedEnumTrait` provides the previous `Enum` class methods that are still relevant
and needed with the switch to enums, including a `jsonSerializable()` method to keep serialization consistent.
- `Bytes\EnumSerializerBundle\Enums\BackedEnumInterface` must be implemented (or `\JsonSerializable`) in order to have
the serializer properly return label/value as it did prior to 2.0.

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


use Bytes\EnumSerializerBundle\Enums\BackedEnumInterface;
use Bytes\EnumSerializerBundle\Enums\BackedEnumTrait;

enum ValuesEnum: string implements BackedEnumInterface
{
    use BackedEnumTrait;

    case streamChanged = 'stream';
    case userChanged = 'user';
}
```

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
[![License](https://i.creativecommons.org/l/by-nc/4.0/88x31.png)]("http://creativecommons.org/licenses/by-nc/4.0/)  
enum-serializer-bundle by [MrGoodBytes](https://www.goodbytes.live) is licensed under a [Creative Commons Attribution-NonCommercial 4.0 International License](http://creativecommons.org/licenses/by-nc/4.0/).  
Based on a work at [https://github.com/mrgoodbytes8667/enum-serializer-bundle](https://github.com/mrgoodbytes8667/enum-serializer-bundle).