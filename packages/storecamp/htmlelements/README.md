# storecamp/htmlelements

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

storecamp e-commerce set of html elements

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
src/
tests/
```


## Install

Via Composer

``` bash
$ composer require https://github.com/storecamp/htmlelements
```

## Usage

in app.php add service provider
``` php
storecamp\htmlelements\HtmlElementsServiceProvider::class,

```

##Facades
add this in app php in alias area
```
        'Accordion' => 'storecamp\htmlelements\Facades\Accordion',
        'Alert' => 'storecamp\htmlelements\Facades\Alert',
        'Badge' => 'storecamp\htmlelements\Facades\Badge',
        'Breadcrumb' => 'storecamp\htmlelements\Facades\Breadcrumb',
        'Button' => 'storecamp\htmlelements\Facades\Button',
        'ButtonGroup' => 'storecamp\htmlelements\Facades\ButtonGroup',
        'Carousel' => 'storecamp\htmlelements\Facades\Carousel',
        'ControlGroup' => 'storecamp\htmlelements\Facades\ControlGroup',
        'DropdownButton' => 'storecamp\htmlelements\Facades\DropdownButton',
        'Forms' => 'storecamp\htmlelements\Facades\Form',
        'Helpers' => 'storecamp\htmlelements\Facades\Helpers',
        'Icon' => 'storecamp\htmlelements\Facades\Icon',
        'InputGroup' => 'storecamp\htmlelements\Facades\InputGroup',
        'Images' => 'storecamp\htmlelements\Facades\Image',
        'Label' => 'storecamp\htmlelements\Facades\Label',
        'MediaObject' => 'storecamp\htmlelements\Facades\MediaObject',
        'Modal' => 'storecamp\htmlelements\Facades\Modal',
        'Navbar' => 'storecamp\htmlelements\Facades\Navbar',
        'Navigation' => 'storecamp\htmlelements\Facades\Navigation',
        'Panel' => 'storecamp\htmlelements\Facades\Panel',
        'ProgressBar' => 'storecamp\htmlelements\Facades\ProgressBar',
        'Tabbable' => 'storecamp\htmlelements\Facades\Tabbable',
        'Table' => 'storecamp\htmlelements\Facades\Table',
        'Thumbnail' => 'storecamp\htmlelements\Facades\Thumbnail',
        'Menu' => \storecamp\htmlelements\Facades\Menu::class,
```
## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email nikoleivan@gmail.com instead of using the issue tracker.

## Credits

- [nilsenj][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/https://github.com/nilsenj/storecamp/htmlelements.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/https://github.com/nilsenj/storecamp/htmlelements/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/https://github.com/nilsenj/storecamp/htmlelements.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/https://github.com/nilsenj/storecamp/htmlelements.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/https://github.com/nilsenj/storecamp/htmlelements.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/https://github.com/nilsenj/storecamp/htmlelements
[link-travis]: https://travis-ci.org/https://github.com/nilsenj/storecamp/htmlelements
[link-scrutinizer]: https://scrutinizer-ci.com/g/https://github.com/nilsenj/storecamp/htmlelements/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/https://github.com/nilsenj/storecamp/htmlelements
[link-downloads]: https://packagist.org/packages/https://github.com/nilsenj/storecamp/htmlelements
[link-author]: https://github.com/https://github.com/nilsenj
[link-contributors]: ../../contributors
