# BayLinks Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/palpalani/baylinks-laravel.svg?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/palpalani/baylinks-laravel.svg?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)

BayLinks PHP SDK for Laravel framework.

[BayLinks](https://baylinks.io) is a powerful URL shortening and management platform tailored for modern businesses. As a Software as a Service (SaaS) solution, BayLinks empowers organizations to create, customize, and track short links effortlessly. Perfect for marketing campaigns, email newsletters, and internal communications, [BayLinks](https://baylinks.io) simplifies link sharing and enhances brand visibility. With robust analytics and customizable branding options, [BayLinks](https://baylinks.io) is the go-to solution for businesses seeking efficient link management and optimization.

## Installation

You can install the package via composer:

```bash
composer require palpalani/baylinks-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="baylinks-laravel-config"
```

## Usage

```php
Update the server information:

return [
    'server' => env('BAYLINKS_SERVER'), // Server domain

    'api' => [
        'url' => 'api/v1', // API Version
    ],
];
```

```php
Get the account Information:

$bayLinks = BayLinks::client();
$bayLinks->accountDetails()->get(<BAYLINKS_API_KEY>);

```

```php
Create a Single Short URL:

$bayLinks->createShortURL()
    ->post(<BAYLINKS_API_KEY>, 
        [
            "destination" => "<Source URL>", // required
            "domain" => "<Custom domain>" // optional
        ]
    );
```

```php
Create a Bulk Short URL:

$bayLinks->createBulkURL()
    ->post(<BAYLINKS_API_KEY>, 
        [
            "destination": [  // required
                "<Source URL>",
                "<Source URL>"
                .
                .
                "<Source URL>"
            ],
            "domain": "<Custom domain>",// optional
            "planet": "jupiter", // optional
            "expire": 0, // optional
            "tag": [] // optional callback data 
        ]
    );
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
