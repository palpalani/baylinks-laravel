<?php

namespace PalPalani\BayLinks\Requests\City;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Responses\City\GetCityResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetCityRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $cityId)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return "/City/$this->cityId";
    }

    public function createDtoFromResponse(Response $response): City
    {
        return GetCityResponse::make($response);
    }
}
