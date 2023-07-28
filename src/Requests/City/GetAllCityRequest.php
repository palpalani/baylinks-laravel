<?php

namespace PalPalani\BayLinks\Requests\City;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Responses\City\GetAllCityResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetAllCityRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/City';
    }

    /**
     * @return Listed<City>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetAllCityResponse::make($response);
    }
}
