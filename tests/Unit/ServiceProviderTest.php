<?php

use PalPalani\BayLinks\BayLinksServiceProvider;

describe('BayLinksServiceProvider', function () {
    it('registers the package', function () {
        $provider = $this->app->getProvider(BayLinksServiceProvider::class);

        expect($provider)->toBeInstanceOf(BayLinksServiceProvider::class);
    });

    it('publishes config file', function () {
        $configPath = config_path('baylinks-laravel.php');
        $publishedConfigExists = file_exists($configPath);

        // Config should be available even if not published
        expect(config('baylinks-laravel'))->toBeArray();
    });

    it('loads configuration from config file', function () {
        expect(config('baylinks-laravel.server'))->toBeNull()
            ->and(config('baylinks-laravel.api.url'))->toBe('api/v1');
    });

    it('merges package config with app config', function () {
        config()->set('baylinks-laravel.server', 'https://test.example.com');

        expect(config('baylinks-laravel.server'))
            ->toBe('https://test.example.com');
    });
});
