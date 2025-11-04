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
    it('resources have Resource suffix')
        ->expect('PalPalani\BayLinks\Resources')
        ->toHaveSuffix('Resource');

    it('requests have Request suffix')
        ->expect('PalPalani\BayLinks\Requests')
        ->toHaveSuffix('Request');

    it('responses have Response suffix')
        ->expect('PalPalani\BayLinks\Responses')
        ->toHaveSuffix('Response');

    it('objects are in Objects namespace')
        ->expect('PalPalani\BayLinks\Objects')
        ->toBeClasses();
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
