<?php

use PalPalani\BayLinks\BayLinks;
use PalPalani\BayLinks\Factory;

test('can create a client instance', function () {
    $client = BayLinks::client();

    expect($client)->toBeInstanceOf(Factory::class);
});

test('can create a factory instance', function () {
    $factory = BayLinks::factory();

    expect($factory)->toBeInstanceOf(Factory::class);
});

test('client and factory return same type', function () {
    $client = BayLinks::client();
    $factory = BayLinks::factory();

    expect($client)->toBeInstanceOf(Factory::class);
    expect($factory)->toBeInstanceOf(Factory::class);
    expect(get_class($client))->toBe(get_class($factory));
});

test('creates new instances on each call', function () {
    $client1 = BayLinks::client();
    $client2 = BayLinks::client();

    expect($client1 !== $client2)->toBeTrue();
});
