<?php

namespace PalPalani\BayLinks\Requests\President;

use PalPalani\BayLinks\Objects\President;
use PalPalani\BayLinks\Responses\President\GetPresidentResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetPresidentRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $presidentId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/President/$this->presidentId";
    }

    public function createDtoFromResponse(Response $response): President
    {
        return GetPresidentResponse::make($response);
    }
}
