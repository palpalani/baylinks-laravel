<?php

namespace PalPalani\BayLinks\Resources;

use Saloon\Http\Connector;

abstract class Resource
{
    public function __construct(protected Connector $connector)
    {
        //
    }
}
