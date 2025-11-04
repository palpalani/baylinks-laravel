<?php

use PalPalani\BayLinks\Resources\Resource;
use Saloon\Http\Connector;
use Saloon\Http\Request;

describe('Architecture', function () {
    it('will not use debugging functions')
        ->expect(['dd', 'dump', 'ray', 'var_dump', 'print_r'])
        ->not->toBeUsed();

    it('does not use die or exit')
        ->expect(['die', 'exit'])
        ->not->toBeUsed();
});

describe('Naming Conventions', function () {
    it('resources have Resource suffix', function () {
        $resources = [
            'PalPalani\BayLinks\Resources\AccountResource',
            'PalPalani\BayLinks\Resources\CreateShortURLResource',
            'PalPalani\BayLinks\Resources\CreateBulkURLResource',
            'PalPalani\BayLinks\Resources\ShortUrlVisitRecordResource',
            'PalPalani\BayLinks\Resources\UpdateShortURLStatusResource',
        ];

        foreach ($resources as $resource) {
            expect(class_exists($resource))->toBeTrue()
                ->and(str_ends_with($resource, 'Resource'))->toBeTrue();
        }
    });

    it('requests have Request suffix', function () {
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

        expect($requests)->not->toBeEmpty();

        foreach ($requests as $file) {
            expect(basename($file))->toEndWith('Request.php');
        }
    });

    it('responses have Response suffix', function () {
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

        expect($responses)->not->toBeEmpty();

        foreach ($responses as $file) {
            expect(basename($file))->toEndWith('Response.php');
        }
    });

    it('objects are in Objects namespace', function () {
        $objects = glob(__DIR__.'/../src/Objects/*.php');
        expect($objects)->not->toBeEmpty();

        foreach ($objects as $file) {
            $class = 'PalPalani\\BayLinks\\Objects\\'.basename($file, '.php');
            expect(class_exists($class) || interface_exists($class))->toBeTrue();
        }
    });
});

describe('Dependencies', function () {
    it('factories extend Saloon Connector')
        ->expect('PalPalani\BayLinks\Factory')
        ->toExtend(Connector::class);

    it('resources extend base Resource')
        ->expect('PalPalani\BayLinks\Resources\AccountResource')
        ->toExtend(Resource::class)
        ->and('PalPalani\BayLinks\Resources\CreateShortURLResource')
        ->toExtend(Resource::class)
        ->and('PalPalani\BayLinks\Resources\CreateBulkURLResource')
        ->toExtend(Resource::class);

    it('requests extend Saloon Request')
        ->expect('PalPalani\BayLinks\Requests')
        ->toExtend(Request::class);
});

describe('Code Quality', function () {
    it('ensures classes are final where appropriate')
        ->expect('PalPalani\BayLinks\BayLinks')
        ->toBeFinal()
        ->and('PalPalani\BayLinks\Factory')
        ->toBeFinal();

    it('globals are not accessed')
        ->expect('PalPalani\BayLinks')
        ->not->toUse(['$_GET', '$_POST', '$_REQUEST', '$_SESSION', '$_COOKIE', '$_SERVER']);
});
