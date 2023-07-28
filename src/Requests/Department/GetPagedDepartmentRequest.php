<?php

namespace PalPalani\BayLinks\Requests\Department;

use PalPalani\BayLinks\Objects\Department;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Responses\Department\GetPagedDepartmentResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetPagedDepartmentRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(public int $page, public int $pageSize)
    {

    }

    public function resolveEndpoint(): string
    {
        return '/Department/pagedList';
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
     * @return Paged<Department>
     */
    public function createDtoFromResponse(Response $response): Paged
    {
        return GetPagedDepartmentResponse::make($response);
    }
}
