<?php

namespace PalPalani\BayLinks\Requests\CategoryNaturalArea;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Responses\CategoryNaturalArea\GetCategoryNaturalAreaNaturalAreaResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetCategoryNaturalAreaAllNaturalAreaRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $categoryNaturalAreaId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/CategoryNaturalArea/$this->categoryNaturalAreaId/NaturalAreas";
    }

    /**
     * @return Listed<NaturalArea>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetCategoryNaturalAreaNaturalAreaResponse::make($response);
    }
}
