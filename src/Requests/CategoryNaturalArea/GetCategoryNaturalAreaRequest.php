<?php

namespace PalPalani\BayLinks\Requests\CategoryNaturalArea;

use PalPalani\BayLinks\Objects\CategoryNaturalArea;
use PalPalani\BayLinks\Responses\CategoryNaturalArea\GetCategoryNaturalAreaResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetCategoryNaturalAreaRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $categoryNaturalAreaId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/CategoryNaturalArea/$this->categoryNaturalAreaId";
    }

    public function createDtoFromResponse(Response $response): CategoryNaturalArea
    {
        return GetCategoryNaturalAreaResponse::make($response);
    }
}
