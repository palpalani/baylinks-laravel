<?php

declare(strict_types=1);

namespace PalPalani\BayLinks;

use PalPalani\BayLinks\Resources\AccountResource;
use Saloon\Http\Connector;

final class Factory extends Connector
{
    public string $apiVersion = 'v1';

    /**
     * Resolve the base URL of the service.
     */
    public function resolveBaseUrl(): string
    {
        return "https://api-colombia.com/api/{$this->apiVersion}";
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
        ];
    }

    public function withApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }
    public function countries(): AccountResource
    {
        return new AccountResource($this);
    }
}
