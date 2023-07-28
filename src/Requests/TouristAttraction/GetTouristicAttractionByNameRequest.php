<?php

namespace PalPalani\BayLinks\Requests\TouristAttraction;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\TouristAttraction;
use PalPalani\BayLinks\Responses\TouristAttraction\GetAllTouristicAttractionResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetTouristicAttractionByNameRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected string $touristicAttractionName)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/TouristicAttraction/name/$this->touristicAttractionName";
    }

    /**
     * @return Listed<TouristAttraction>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetAllTouristicAttractionResponse::make($response);
    }
}
