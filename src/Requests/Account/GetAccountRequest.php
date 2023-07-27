<?php

namespace Palpalani\BayLinks\Requests\Account;

use Palpalani\BayLinks\Objects\Account;
use Palpalani\BayLinks\Responses\Account\GetAccountResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetAccountRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/account';
    }
/* 
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Api-Key' => config('baylinks-laravel.api.key'),
            'Api-Secret' => config('baylinks-laravel.api.secret'),
        ];
    } */

    public function createDtoFromResponse(Response $response): Account
    {
        return GetAccountResponse::make($response);
    }
}
