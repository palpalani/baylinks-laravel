<?php

namespace PalPalani\BayLinks\Requests\President;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\President;
use PalPalani\BayLinks\Responses\President\GetAllPresidentResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetAllPresidentRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/President';
    }

    /**
     * @return Listed<President>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetAllPresidentResponse::make($response);
    }
}
