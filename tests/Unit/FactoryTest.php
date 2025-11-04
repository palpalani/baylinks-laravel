<?php

use PalPalani\BayLinks\Factory;
use PalPalani\BayLinks\Resources\AccountResource;
use PalPalani\BayLinks\Resources\CreateBulkURLResource;
use PalPalani\BayLinks\Resources\CreateShortURLResource;
use PalPalani\BayLinks\Resources\ShortUrlVisitRecordResource;
use PalPalani\BayLinks\Resources\UpdateShortURLStatusResource;

beforeEach(function () {
    config()->set('baylinks-laravel.server', 'https://baylinks.io');
    config()->set('baylinks-laravel.api.url', 'api/v1');
});

test('can be instantiated', function () {
    $factory = new Factory;

    expect($factory)->toBeInstanceOf(Factory::class);
});

test('resolves correct base URL', function () {
    $factory = new Factory;

    expect($factory->resolveBaseUrl())
        ->toBe('https://baylinks.io/api/v1');
});

test('handles server URL with trailing slash', function () {
    config()->set('baylinks-laravel.server', 'https://baylinks.io/');

    $factory = new Factory;

    expect($factory->resolveBaseUrl())
        ->toContain('baylinks.io');
});

test('provides accountDetails resource', function () {
    $factory = new Factory;

    expect($factory->accountDetails())
        ->toBeInstanceOf(AccountResource::class);
});

test('provides createShortURL resource', function () {
    $factory = new Factory;

    expect($factory->createShortURL())
        ->toBeInstanceOf(CreateShortURLResource::class);
});

test('provides createBulkURL resource', function () {
    $factory = new Factory;

    expect($factory->createBulkURL())
        ->toBeInstanceOf(CreateBulkURLResource::class);
});

test('provides ShortUrlVisitRecord resource', function () {
    $factory = new Factory;

    expect($factory->ShortUrlVisitRecord())
        ->toBeInstanceOf(ShortUrlVisitRecordResource::class);
});

test('provides updateShortURLStatus resource', function () {
    $factory = new Factory;

    expect($factory->updateShortURLStatus())
        ->toBeInstanceOf(UpdateShortURLStatusResource::class);
});

test('returns new resource instances on each call', function () {
    $factory = new Factory;

    $resource1 = $factory->accountDetails();
    $resource2 = $factory->accountDetails();

    expect($resource1 !== $resource2)->toBeTrue();
});
