<div align="center">

# BayLinks Laravel

**A modern, type-safe Laravel SDK for the BayLinks URL shortening platform**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/palpalani/baylinks-laravel.svg?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3Aphpstan+branch%3Amain)
[![Code Coverage](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/coverage.yml?branch=main&label=coverage&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Code+Coverage"+branch%3Amain)
[![Security Scan](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/security.yml?branch=main&label=security&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Security+Scan"+branch%3Amain)
[![Code Style](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

[![Total Downloads](https://img.shields.io/packagist/dt/palpalani/baylinks-laravel.svg?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)
[![PHP Version](https://img.shields.io/packagist/php-v/palpalani/baylinks-laravel?style=flat-square)](https://packagist.org/packages/palpalani/baylinks-laravel)
[![Laravel Version](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/packagist/l/palpalani/baylinks-laravel.svg?style=flat-square)](LICENSE.md)

[Features](#features) •
[Installation](#installation) •
[Usage](#usage) •
[API Reference](#api-reference) •
[Contributing](#contributing)

</div>

---

## About

This Laravel package provides an elegant, fluent interface to the [BayLinks](https://baylinks.io) API - a powerful URL shortening and management platform for modern businesses. Built on top of [Saloon PHP](https://docs.saloon.dev/), this SDK offers type-safe request/response handling, robust error management, and seamless Laravel integration.

## Features

- **🎯 Type-Safe**: Full PHP 8.3+ type safety with PHPStan level 4 analysis
- **🚀 Modern Architecture**: Built on Saloon PHP for elegant HTTP client abstraction
- **🔒 Secure**: Per-request API key authentication with built-in error handling
- **🧪 Well-Tested**: Comprehensive test suite with Pest PHP
- **📦 Laravel Native**: First-class Laravel integration with service provider and facade
- **🔄 Bulk Operations**: Support for bulk URL creation and management
- **📊 Analytics**: Track URL visit records and performance metrics
- **🎨 PSR Compliant**: Follows PSR-1, PSR-2, and PSR-12 coding standards

## Requirements

- PHP 8.3 or higher
- Laravel 10.x, 11.x, or 12.x
- Composer 2.x

## Installation

Install the package via Composer:

```bash
composer require palpalani/baylinks-laravel
```

### Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag="baylinks-laravel-config"
```

This creates `config/baylinks-laravel.php` with the following structure:

```php
return [
    'server' => env('BAYLINKS_SERVER'),

    'api' => [
        'url' => 'api/v1',
        'key' => env('BAYLINKS_API_KEY'),
        'secret' => env('BAYLINKS_API_SECRET'),
    ],
];
```

Update your `.env` file:

```env
BAYLINKS_SERVER=https://baylinks.io
BAYLINKS_API_KEY=your_api_key_here
BAYLINKS_API_SECRET=your_api_secret_here
```

## Usage

### Basic Examples

#### Retrieve Account Information

```php
use PalPalani\BayLinks\Facades\BayLinks;

$client = BayLinks::client();
$account = $client->accountDetails()->get('your_api_key');
```

#### Create a Single Short URL

```php
use PalPalani\BayLinks\Facades\BayLinks;

$client = BayLinks::client();

$shortUrl = $client->createShortURL()->post('your_api_key', [
    'destination' => 'https://example.com/very-long-url',
    'domain' => 'custom.domain.com', // optional
]);
```

#### Create Multiple Short URLs (Bulk)

```php
use PalPalani\BayLinks\Facades\BayLinks;

$client = BayLinks::client();

$bulkUrls = $client->createBulkURL()->post('your_api_key', [
    'destination' => [
        'https://example.com/page-1',
        'https://example.com/page-2',
        'https://example.com/page-3',
    ],
    'domain' => 'custom.domain.com', // optional
    'planet' => 'jupiter', // optional
    'expire' => 0, // optional (0 = never expires)
    'tag' => ['campaign' => 'summer-2024'], // optional metadata
]);
```

### Advanced Usage

#### Update Short URL Status

```php
$client = BayLinks::client();

$response = $client->updateShortURLStatus()->post('your_api_key', [
    'url_id' => 'abc123',
    'status' => 'inactive',
]);
```

#### Retrieve Visit Records

```php
$client = BayLinks::client();

$visitRecords = $client->ShortUrlVisitRecord()->post('your_api_key', [
    'url_id' => 'abc123',
    'from_date' => '2024-01-01',
    'to_date' => '2024-12-31',
]);
```

#### Using Dependency Injection

```php
use PalPalani\BayLinks\Factory;

class UrlShortenerService
{
    public function __construct(
        private Factory $bayLinks
    ) {}

    public function shortenUrl(string $url, string $apiKey): mixed
    {
        return $this->bayLinks
            ->createShortURL()
            ->post($apiKey, ['destination' => $url]);
    }
}
```

#### Error Handling

```php
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

try {
    $shortUrl = BayLinks::client()
        ->createShortURL()
        ->post('your_api_key', [
            'destination' => 'https://example.com',
        ]);
} catch (FatalRequestException $e) {
    // Handle fatal errors (network issues, timeouts, etc.)
    Log::error('BayLinks fatal error: ' . $e->getMessage());
} catch (RequestException $e) {
    // Handle API errors (validation, authentication, etc.)
    Log::error('BayLinks API error: ' . $e->getMessage());

    // Access response details
    $statusCode = $e->getStatus();
    $responseBody = $e->getResponse()->body();
}
```

## API Reference

### Client Initialization

```php
use PalPalani\BayLinks\Facades\BayLinks;

$client = BayLinks::client();
// or
$client = BayLinks::factory();
```

### Available Methods

#### Account Operations

| Method | Description | Parameters |
|--------|-------------|------------|
| `accountDetails()->get($apiKey)` | Retrieve account information | `string $apiKey` |

#### URL Operations

| Method | Description | Parameters |
|--------|-------------|------------|
| `createShortURL()->post($apiKey, $data)` | Create a single short URL | `string $apiKey`, `array $data` |
| `createBulkURL()->post($apiKey, $data)` | Create multiple short URLs | `string $apiKey`, `array $data` |
| `updateShortURLStatus()->post($apiKey, $data)` | Update URL status | `string $apiKey`, `array $data` |
| `ShortUrlVisitRecord()->post($apiKey, $data)` | Get visit analytics | `string $apiKey`, `array $data` |

### Request Payload Schemas

#### Create Short URL

```php
[
    'destination' => 'https://example.com/page',  // required
    'domain' => 'custom.domain.com',              // optional
]
```

#### Create Bulk URLs

```php
[
    'destination' => [                              // required (array of URLs)
        'https://example.com/page-1',
        'https://example.com/page-2',
    ],
    'domain' => 'custom.domain.com',               // optional
    'planet' => 'jupiter',                         // optional
    'expire' => 0,                                 // optional (seconds, 0 = never)
    'tag' => ['key' => 'value'],                   // optional (metadata)
]
```

## Testing

Run the full test suite with Pest:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

Run specific test file:

```bash
vendor/bin/pest tests/ExampleTest.php
```

Run tests with filtering:

```bash
vendor/bin/pest --filter=CanCreateShortUrl
```

### Code Quality

Run PHPStan static analysis:

```bash
composer analyse
```

Format code with Laravel Pint:

```bash
composer format
```

## Development

### Architecture

This package uses [Saloon PHP](https://docs.saloon.dev/) for HTTP client abstraction:

- **Factory**: Main connector extending `Saloon\Http\Connector`
- **Resources**: Group related API endpoints (`AccountResource`, `CreateShortURLResource`)
- **Requests**: Individual API requests extending `Saloon\Http\Request`
- **Responses**: Transform API responses to DTOs
- **Objects**: Immutable data transfer objects

### Adding New Endpoints

1. Create a new Request class in `src/Requests/{Category}/`
2. Create a corresponding Response class in `src/Responses/{Category}/`
3. Add a Resource method or create new Resource in `src/Resources/`
4. Update the Factory with a new resource method if needed
5. Write tests in `tests/`

See [CLAUDE.md](CLAUDE.md) for detailed development guidelines.

## Troubleshooting

### Common Issues

#### "Class 'BayLinks' not found"

Make sure you've published the service provider:

```bash
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

#### Authentication Errors

Verify your API key is correct and active:

```php
// Test connection
try {
    $account = BayLinks::client()->accountDetails()->get('your_api_key');
    dump($account);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

#### SSL Certificate Issues

If you encounter SSL errors in development:

```php
// In config/baylinks-laravel.php (development only!)
// Note: Never disable SSL verification in production
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for recent changes and version history.

## Contributing

We welcome contributions! Here's how you can help:

### Getting Started

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/my-new-feature`
3. Make your changes and commit: `git commit -am 'Add new feature'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

### Development Guidelines

- Follow PSR-1, PSR-2, and PSR-12 coding standards
- Write tests for new features (we use Pest)
- Ensure PHPStan passes at level 4: `composer analyse`
- Format code with Pint: `composer format`
- Update documentation for API changes
- Add entries to CHANGELOG.md

### Running Tests

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run static analysis
composer analyse

# Format code
composer format
```

### Pull Request Checklist

- [ ] Tests pass (`composer test`)
- [ ] Static analysis passes (`composer analyse`)
- [ ] Code is formatted (`composer format`)
- [ ] Documentation is updated
- [ ] CHANGELOG.md is updated

## Security

If you discover any security-related issues, please email [palani.p@gmail.com](mailto:palani.p@gmail.com) instead of using the issue tracker. All security vulnerabilities will be promptly addressed.

## Credits

- **[palPalani](https://github.com/palpalani)** - Creator & Maintainer
- **[Prasanth](mailto:prasanth.s@targetbay.com)** - Core Developer
- **[All Contributors](../../contributors)** - Community Contributors

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

<div align="center">

**[⬆ Back to Top](#baylinks-laravel)**

Made with ❤️ by [palPalani](https://github.com/palpalani)

</div>
