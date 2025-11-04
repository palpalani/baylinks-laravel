<?php

use PalPalani\BayLinks\BayLinks;

test('uses environment variables for server', function () {
    config()->set('baylinks-laravel.server', 'https://custom.baylinks.io');

    $client = BayLinks::client();
    $baseUrl = $client->resolveBaseUrl();

    expect($baseUrl)->toContain('custom.baylinks.io');
});

test('has default API version', function () {
    $apiUrl = config('baylinks-laravel.api.url');

    expect($apiUrl)->toBe('api/v1');
});

test('can customize API version', function () {
    config()->set('baylinks-laravel.api.url', 'api/v2');

    $client = BayLinks::client();
    $baseUrl = $client->resolveBaseUrl();

    expect($baseUrl)->toContain('api/v2');
});

test('builds correct base URL from config', function () {
    config()->set('baylinks-laravel.server', 'https://api.example.com');
    config()->set('baylinks-laravel.api.url', 'v1/baylinks');

    $client = BayLinks::client();
    $baseUrl = $client->resolveBaseUrl();

    expect($baseUrl)->toBe('https://api.example.com/v1/baylinks');
});

test('handles missing server configuration gracefully', function () {
    config()->set('baylinks-laravel.server', null);

    $client = BayLinks::client();
    $baseUrl = $client->resolveBaseUrl();

    expect($baseUrl)->toContain('api/v1');
});
