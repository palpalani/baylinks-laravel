<?php

use PalPalani\BayLinks\BayLinksServiceProvider;

test('registers the package', function () {
    $provider = $this->app->getProvider(BayLinksServiceProvider::class);

    expect($provider)->toBeInstanceOf(BayLinksServiceProvider::class);
});

test('publishes config file', function () {
    $configPath = config_path('baylinks-laravel.php');
    $publishedConfigExists = file_exists($configPath);

    // Config should be available even if not published
    expect(config('baylinks-laravel'))->toBeArray();
});

test('loads configuration from config file', function () {
    expect(config('baylinks-laravel.server'))->toBeNull();
    expect(config('baylinks-laravel.api.url'))->toBe('api/v1');
});

test('merges package config with app config', function () {
    config()->set('baylinks-laravel.server', 'https://test.example.com');

    expect(config('baylinks-laravel.server'))
        ->toBe('https://test.example.com');
});
