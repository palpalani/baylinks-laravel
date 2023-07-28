<?php

namespace PalPalani\BayLinks\Requests\Department;

use PalPalani\BayLinks\Objects\Department;
use PalPalani\BayLinks\Responses\Department\GetDepartmentResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

/*
 * @TODO: review endpoint, is currently throwing a 404
 */
final class GetDepartmentRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $departmentId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/Department/$this->departmentId";
    }

    public function createDtoFromResponse(Response $response): Department
    {
        return GetDepartmentResponse::make($response);
    }
}
