# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

BayLinks Laravel is a Laravel package that provides a PHP SDK for the BayLinks URL shortening service. It's built using:
- Saloon PHP (v3) for HTTP client abstraction
- Laravel Package Tools for service provider scaffolding
- Pest (v4) for testing
- PHPStan (level 4) for static analysis
- Laravel Pint for code formatting

## Development Commands

### Testing
```bash
composer test                # Run all tests with Pest
composer test-coverage       # Run tests with coverage report
vendor/bin/pest --filter=TestName  # Run a specific test
```

### Code Quality
```bash
composer format              # Format code with Laravel Pint
composer analyse             # Run PHPStan static analysis
```

### Package Discovery
```bash
composer dump-autoload       # Regenerate autoload files (triggers package discovery)
```

## Architecture

### Saloon-Based HTTP Client Pattern

The package uses Saloon's connector/resource/request pattern:

1. **Factory (Connector)**: `src/Factory.php` extends `Saloon\Http\Connector`
   - Defines base URL from config: `{server}/{api.url}` (e.g., `https://baylinks.io/api/v1`)
   - Sets default headers (Accept, Content-Type)
   - Provides factory methods for each resource

2. **Resources**: `src/Resources/*Resource.php` extend `Resource`
   - Each resource wraps a group of related API endpoints
   - Resources receive the Factory connector in constructor
   - Example: `AccountResource`, `CreateShortURLResource`, `CreateBulkURLResource`

3. **Requests**: `src/Requests/**/*Request.php` extend `Saloon\Http\Request`
   - Define HTTP method, endpoint, headers
   - Handle authentication (API key passed per-request, not globally)
   - Use `AlwaysThrowOnErrors` trait
   - Map responses to DTOs via `createDtoFromResponse()`

4. **Responses**: `src/Responses/**/*Response.php`
   - Static `make()` methods transform Saloon responses into DTOs

5. **Objects (DTOs)**: `src/Objects/*.php`
   - Immutable data transfer objects implementing `DataTransferObject` contract

### Authentication Flow

API authentication uses per-request API keys, NOT global configuration:
```php
// API key is passed to each method call, not configured globally
$bayLinks = BayLinks::client();
$bayLinks->accountDetails()->get($apiKey);
$bayLinks->createShortURL()->post($apiKey, $data);
```

The config file contains API key/secret placeholders but they're not used in default headers. Each request accepts `access_token`/`api_key` parameter and sets `X-Api-Key` header.

### Entry Point

Users interact via the facade:
```php
BayLinks::client()->accountDetails()->get($apiKey);
BayLinks::client()->createShortURL()->post($apiKey, ['destination' => '...']);
```

## Configuration

Published config: `config/baylinks-laravel.php`
```php
'server' => env('BAYLINKS_SERVER'),  // Base URL (e.g., https://baylinks.io)
'api' => [
    'url' => 'api/v1',               // API version path
    'key' => env('BAYLINKS_API_KEY'),     // Not used in default implementation
    'secret' => env('BAYLINKS_API_SECRET'), // Not used in default implementation
]
```

## Adding New Endpoints

To add a new BayLinks API endpoint:

1. Create Request class in `src/Requests/{Category}/{Action}Request.php`
   - Extend `Saloon\Http\Request`
   - Add `AlwaysThrowOnErrors` trait
   - Define `$method`, `resolveEndpoint()`, and optional `defaultHeaders()`
   - Implement `createDtoFromResponse()` to map to DTO

2. Create Response class in `src/Responses/{Category}/{Action}Response.php`
   - Implement static `make(Response $response)` method
   - Transform response data into DTO

3. Create/update DTO in `src/Objects/`
   - Implement `DataTransferObject` contract if needed

4. Create/update Resource in `src/Resources/{Category}Resource.php`
   - Extend `Resource`
   - Add method that sends the Request via `$this->connector->send()`

5. Add factory method to `src/Factory.php` if creating new resource

6. Write tests in `tests/` using Pest

## Package Structure

- `src/BayLinks.php` - Static entry point, creates Factory
- `src/Factory.php` - Saloon connector with resource factory methods
- `src/Resources/` - API resource classes grouping related endpoints
- `src/Requests/` - Saloon request definitions (organized by endpoint category)
- `src/Responses/` - Response transformers to DTOs
- `src/Objects/` - Data transfer objects
- `src/Contracts/` - Interfaces
- `src/Facades/` - Laravel facade
- `src/BayLinksServiceProvider.php` - Package service provider
- `config/baylinks-laravel.php` - Package configuration

## Testing Notes

- Tests use Orchestra Testbench for Laravel package testing
- Pest is configured with Laravel plugin
- Architecture tests in `tests/ArchTest.php` enforce coding standards
- Test coverage reports generated in `build/coverage/`
