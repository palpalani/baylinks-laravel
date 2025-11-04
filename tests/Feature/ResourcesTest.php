<?php

use PalPalani\BayLinks\BayLinks;
use PalPalani\BayLinks\Resources\AccountResource;
use PalPalani\BayLinks\Resources\CreateBulkURLResource;
use PalPalani\BayLinks\Resources\CreateShortURLResource;
use PalPalani\BayLinks\Resources\ShortUrlVisitRecordResource;
use PalPalani\BayLinks\Resources\UpdateShortURLStatusResource;

beforeEach(function () {
    config()->set('baylinks-laravel.server', 'https://baylinks.io');
    config()->set('baylinks-laravel.api.url', 'api/v1');
});

test('can access account details resource', function () {
    $client = BayLinks::client();
    $resource = $client->accountDetails();

    expect($resource)->toBeInstanceOf(AccountResource::class);
});

test('can access create short URL resource', function () {
    $client = BayLinks::client();
    $resource = $client->createShortURL();

    expect($resource)->toBeInstanceOf(CreateShortURLResource::class);
});

test('can access create bulk URL resource', function () {
    $client = BayLinks::client();
    $resource = $client->createBulkURL();

    expect($resource)->toBeInstanceOf(CreateBulkURLResource::class);
});

test('can access visit record resource', function () {
    $client = BayLinks::client();
    $resource = $client->ShortUrlVisitRecord();

    expect($resource)->toBeInstanceOf(ShortUrlVisitRecordResource::class);
});

test('can access update URL status resource', function () {
    $client = BayLinks::client();
    $resource = $client->updateShortURLStatus();

    expect($resource)->toBeInstanceOf(UpdateShortURLStatusResource::class);
});

test('resources are chain-accessible', function () {
    $client = BayLinks::client();

    expect($client->accountDetails())->toBeInstanceOf(AccountResource::class);
    expect($client->createShortURL())->toBeInstanceOf(CreateShortURLResource::class);
    expect($client->createBulkURL())->toBeInstanceOf(CreateBulkURLResource::class);
});
