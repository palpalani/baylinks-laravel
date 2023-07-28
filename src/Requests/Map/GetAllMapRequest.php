<?php

namespace PalPalani\BayLinks\Requests\Map;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Map;
use PalPalani\BayLinks\Responses\Map\GetAllMapResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetAllMapRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/Map';
    }

    /**
     * @return Listed<Map>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetAllMapResponse::make($response);
    }
}
