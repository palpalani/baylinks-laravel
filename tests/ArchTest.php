<?php

use PalPalani\BayLinks\Resources\Resource;
use Saloon\Http\Connector;
use Saloon\Http\Request;

// Architecture tests
test('will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'print_r'])
    ->not->toBeUsed();

test('does not use die or exit')
    ->expect(['die', 'exit'])
    ->not->toBeUsed();

// Naming Conventions
test('resources have Resource suffix', function () {
    $resources = [
        'PalPalani\BayLinks\Resources\AccountResource',
        'PalPalani\BayLinks\Resources\CreateShortURLResource',
        'PalPalani\BayLinks\Resources\CreateBulkURLResource',
        'PalPalani\BayLinks\Resources\ShortUrlVisitRecordResource',
        'PalPalani\BayLinks\Resources\UpdateShortURLStatusResource',
    ];

    foreach ($resources as $resource) {
        expect(class_exists($resource))->toBeTrue();
        expect(str_ends_with($resource, 'Resource'))->toBeTrue();
    }
});

test('requests have Request suffix', function () {
    $path = __DIR__.'/../src/Requests';
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    $requests = [];
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $requests[] = $file->getPathname();
        }
    }

    expect(count($requests) > 0)->toBeTrue();

    foreach ($requests as $file) {
        expect(basename($file))->toEndWith('Request.php');
    }
});

test('responses have Response suffix', function () {
    $path = __DIR__.'/../src/Responses';
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    $responses = [];
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $responses[] = $file->getPathname();
        }
    }

    expect(count($responses) > 0)->toBeTrue();

    foreach ($responses as $file) {
        expect(basename($file))->toEndWith('Response.php');
    }
});

test('objects are in Objects namespace', function () {
    $objects = glob(__DIR__.'/../src/Objects/*.php');
    expect(count($objects) > 0)->toBeTrue();

    foreach ($objects as $file) {
        $class = 'PalPalani\\BayLinks\\Objects\\'.basename($file, '.php');
        expect(class_exists($class) || interface_exists($class))->toBeTrue();
    }
});

// Dependencies
test('factories extend Saloon Connector')
    ->expect('PalPalani\BayLinks\Factory')
    ->toExtend(Connector::class);

test('resources extend base Resource', function () {
    expect('PalPalani\BayLinks\Resources\AccountResource')
        ->toExtend(Resource::class);
    expect('PalPalani\BayLinks\Resources\CreateShortURLResource')
        ->toExtend(Resource::class);
    expect('PalPalani\BayLinks\Resources\CreateBulkURLResource')
        ->toExtend(Resource::class);
});

test('requests extend Saloon Request')
    ->expect('PalPalani\BayLinks\Requests')
    ->toExtend(Request::class);

// Code Quality
test('ensures classes are final where appropriate', function () {
    expect('PalPalani\BayLinks\BayLinks')->toBeFinal();
    expect('PalPalani\BayLinks\Factory')->toBeFinal();
});

test('globals are not accessed')
    ->expect('PalPalani\BayLinks')
    ->not->toUse(['$_GET', '$_POST', '$_REQUEST', '$_SESSION', '$_COOKIE', '$_SERVER']);
