<?php

namespace PalPalani\BayLinks\Resources;

use Saloon\Contracts\Connector;

abstract class Resource
{
    public function __construct(protected Connector $connector)
    {
        //
    }
}
