<?php

use PalPalani\BayLinks\BayLinks;

describe('Package Configuration', function () {
    it('uses environment variables for server', function () {
        config()->set('baylinks-laravel.server', 'https://custom.baylinks.io');

        $client = BayLinks::client();
        $baseUrl = $client->resolveBaseUrl();

        expect($baseUrl)->toContain('custom.baylinks.io');
    });

    it('has default API version', function () {
        $apiUrl = config('baylinks-laravel.api.url');

        expect($apiUrl)->toBe('api/v1');
    });

    it('can customize API version', function () {
        config()->set('baylinks-laravel.api.url', 'api/v2');

        $client = BayLinks::client();
        $baseUrl = $client->resolveBaseUrl();

        expect($baseUrl)->toContain('api/v2');
    });

    it('builds correct base URL from config', function () {
        config()->set('baylinks-laravel.server', 'https://api.example.com');
        config()->set('baylinks-laravel.api.url', 'v1/baylinks');

        $client = BayLinks::client();
        $baseUrl = $client->resolveBaseUrl();

        expect($baseUrl)->toBe('https://api.example.com/v1/baylinks');
    });

    it('handles missing server configuration gracefully', function () {
        config()->set('baylinks-laravel.server', null);

        $client = BayLinks::client();
        $baseUrl = $client->resolveBaseUrl();

        expect($baseUrl)->toContain('api/v1');
    });
});
