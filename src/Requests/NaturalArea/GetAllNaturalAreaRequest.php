<?php

namespace PalPalani\BayLinks\Requests\NaturalArea;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Responses\NaturalArea\GetAllNaturalAreaResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetAllNaturalAreaRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/NaturalArea';
    }

    /**
     * @return Listed<NaturalArea>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetAllNaturalAreaResponse::make($response);
    }
}
