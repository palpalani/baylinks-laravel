<?php

namespace PalPalani\BayLinks\Requests\Department;

use PalPalani\BayLinks\Objects\Department;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Responses\Department\GetAllDepartmentResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetDepartmentBySearchRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected string $searchValue)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/Department/search/$this->searchValue";
    }

    /**
     * @return Listed<Department>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetAllDepartmentResponse::make($response);
    }
}
