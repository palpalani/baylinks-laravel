<?php

declare(strict_types=1);

namespace PalPalani\BayLinks;

use PalPalani\BayLinks\Resources\AccountResource;
use PalPalani\BayLinks\Resources\CreateShortURLResource;
use Saloon\Http\Connector;

final class Factory extends Connector
{
    /**
     * Resolve the base URL of the service.
     */
    public function resolveBaseUrl(): string
    {
        return config('baylinks-laravel.server').'/'.config('baylinks-laravel.api.url');
    }

    /**
     * Define default headers
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Api-Key' => config('baylinks-laravel.api.key'),
            'X-Api-Secret' => config('baylinks-laravel.api.secret'),
        ];
    }

    public function accountDetails(): AccountResource
    {
        return new AccountResource($this);
    }

    public function createShortURL(): CreateShortURLResource
    {
        return new CreateShortURLResource($this);
    }
}
