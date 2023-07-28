<?php

namespace PalPalani\BayLinks\Requests\TouristAttraction;

use PalPalani\BayLinks\Objects\TouristAttraction;
use PalPalani\BayLinks\Responses\TouristAttraction\GetTouristicAttractionResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetTouristicAttractionRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $touristicAttractionId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/TouristicAttraction/$this->touristicAttractionId";
    }

    public function createDtoFromResponse(Response $response): TouristAttraction
    {
        return GetTouristicAttractionResponse::make($response);
    }
}
