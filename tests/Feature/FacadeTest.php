<?php

use PalPalani\BayLinks\Facades\BayLinks;
use PalPalani\BayLinks\Factory;

describe('BayLinks Facade', function () {
    it('resolves from container', function () {
        $client = BayLinks::client();

        expect($client)->toBeInstanceOf(Factory::class);
    });

    it('can call static methods through facade', function () {
        $factory = BayLinks::factory();

        expect($factory)->toBeInstanceOf(Factory::class);
    });

    it('facade returns working factory instance', function () {
        config()->set('baylinks-laravel.server', 'https://baylinks.io');
        config()->set('baylinks-laravel.api.url', 'api/v1');

        $client = BayLinks::client();
        $baseUrl = $client->resolveBaseUrl();

        expect($baseUrl)->toBe('https://baylinks.io/api/v1');
    });
});
