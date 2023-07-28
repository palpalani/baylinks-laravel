<?php

namespace PalPalani\BayLinks\Requests\Map;

use PalPalani\BayLinks\Objects\Map;
use PalPalani\BayLinks\Responses\Map\GetMapResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetMapRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $mapId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/Map/$this->mapId";
    }

    public function createDtoFromResponse(Response $response): Map
    {
        return GetMapResponse::make($response);
    }
}
