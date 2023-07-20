# PHP/Laravel framework SDK for BayLinks.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/palpalani/baylinks-laravel.svg?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/palpalani/baylinks-laravel.svg?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require palpalani/baylinks-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="baylinks-laravel-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$bayLinks = new PalPalani\BayLinks();
echo $bayLinks->echoPhrase('Hello, PalPalani!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [palPalani](https://github.com/palpalani)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
