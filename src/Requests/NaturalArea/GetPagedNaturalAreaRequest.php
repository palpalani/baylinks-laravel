<?php

namespace PalPalani\BayLinks\Requests\NaturalArea;

use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Responses\NaturalArea\GetPagedNaturalAreaResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetPagedNaturalAreaRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(public int $page, public int $pageSize)
    {

    }

    public function resolveEndpoint(): string
    {
        return '/NaturalArea/pagedList';
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
     * @return Paged<NaturalArea>
     */
    public function createDtoFromResponse(Response $response): Paged
    {
        return GetPagedNaturalAreaResponse::make($response);
    }
}
