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

    /**
     * access_token
     */
    public function __construct(protected string $access_token)
    {
    }
    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/account';
    }
    protected function defaultHeaders(): array
    {
        return [
            'X-Api-Key' => $this->access_token,
        ];
    }
    public function createDtoFromResponse(Response $response): Account
    {
        return GetAccountResponse::make($response);
    }
}
