<?php

namespace PalPalani\BayLinks\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PalPalani\BayLinks\BayLinks
 */
class BayLinks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PalPalani\BayLinks\BayLinks::class;
    }
}
