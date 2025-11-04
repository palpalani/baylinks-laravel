<?php

use PalPalani\BayLinks\Factory;
use PalPalani\BayLinks\Resources\AccountResource;
use PalPalani\BayLinks\Resources\CreateBulkURLResource;
use PalPalani\BayLinks\Resources\CreateShortURLResource;
use PalPalani\BayLinks\Resources\ShortUrlVisitRecordResource;
use PalPalani\BayLinks\Resources\UpdateShortURLStatusResource;

describe('Factory', function () {
    beforeEach(function () {
        config()->set('baylinks-laravel.server', 'https://baylinks.io');
        config()->set('baylinks-laravel.api.url', 'api/v1');
    });

    it('can be instantiated', function () {
        $factory = new Factory;

        expect($factory)->toBeInstanceOf(Factory::class);
    });

    it('resolves correct base URL', function () {
        $factory = new Factory;

        expect($factory->resolveBaseUrl())
            ->toBe('https://baylinks.io/api/v1');
    });

    it('handles server URL with trailing slash', function () {
        config()->set('baylinks-laravel.server', 'https://baylinks.io/');

        $factory = new Factory;

        expect($factory->resolveBaseUrl())
            ->toContain('baylinks.io');
    });

    it('provides accountDetails resource', function () {
        $factory = new Factory;

        expect($factory->accountDetails())
            ->toBeInstanceOf(AccountResource::class);
    });

    it('provides createShortURL resource', function () {
        $factory = new Factory;

        expect($factory->createShortURL())
            ->toBeInstanceOf(CreateShortURLResource::class);
    });

    it('provides createBulkURL resource', function () {
        $factory = new Factory;

        expect($factory->createBulkURL())
            ->toBeInstanceOf(CreateBulkURLResource::class);
    });

    it('provides ShortUrlVisitRecord resource', function () {
        $factory = new Factory;

        expect($factory->ShortUrlVisitRecord())
            ->toBeInstanceOf(ShortUrlVisitRecordResource::class);
    });

    it('provides updateShortURLStatus resource', function () {
        $factory = new Factory;

        expect($factory->updateShortURLStatus())
            ->toBeInstanceOf(UpdateShortURLStatusResource::class);
    });

    it('returns new resource instances on each call', function () {
        $factory = new Factory;

        $resource1 = $factory->accountDetails();
        $resource2 = $factory->accountDetails();

        expect($resource1 !== $resource2)->toBeTrue();
    });
});
