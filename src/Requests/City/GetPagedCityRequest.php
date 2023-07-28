<?php

namespace PalPalani\BayLinks\Requests\City;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Responses\City\GetPagedCityResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetPagedCityRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(public int $page, public int $pageSize)
    {

    }

    public function resolveEndpoint(): string
    {
        return '/City/pagedList';
    }

    /**
     * @return array{Page: int, PageSize: int}
     */
    protected function defaultQuery(): array
    {
        return [
            'Page' => $this->page,
            'PageSize' => $this->pageSize,
        ];
    }

    /**
     * @return Paged<City>
     */
    public function createDtoFromResponse(Response $response): Paged
    {
        return GetPagedCityResponse::make($response);
    }
}
