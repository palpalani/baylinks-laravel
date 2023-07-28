<?php

namespace PalPalani\BayLinks\Requests\Account;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Responses\Account\GetAccountResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetAccountRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected string $country)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return "/Country/{$this->country}";
    }

    public function createDtoFromResponse(Response $response): Account
    {
        return GetAccountResponse::make($response);
    }
}
