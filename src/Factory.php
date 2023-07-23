<?php

namespace Palpalani\BayLinks;

use Palpalani\BayLinks\Resources\AccountResource;
use Palpalani\BayLinks\Resources\GenerateLinkResource;
use Saloon\Http\Connector;

final class Factory extends Connector
{
    public string $apiVersion = 'v1';

    /**
     * Resolve the base URL of the service.
     */
    public function resolveBaseUrl(): string
    {
        return config('baylinks-laravel.server') . "/" . config('baylinks-laravel.api.url');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Api-Key' => config('baylinks-laravel.api.key'),
            'Api-Secret' => config('baylinks-laravel.api.secret'),
        ];
    }

    public function withApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function accountDetails(): AccountResource
    {
        return new AccountResource($this);
    }

    public function generateLink(): GenerateLinkResource
    {
        return new GenerateLinkResource($this);
    }
}
