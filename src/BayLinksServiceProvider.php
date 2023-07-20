<?php

namespace PalPalani\BayLinks;

use PalPalani\BayLinks\Commands\BayLinksCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BayLinksServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('baylinks-laravel')
            ->hasConfigFile();
    }
}
