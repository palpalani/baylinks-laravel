<?php

namespace Palpalani\BayLinks\Resources;

use Saloon\Contracts\Connector;

abstract class Resource
{
    public function __construct(protected Connector $connector)
    {
        //
    }
}
