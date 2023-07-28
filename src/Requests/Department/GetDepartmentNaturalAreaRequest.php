<?php

namespace PalPalani\BayLinks\Requests\Department;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Responses\Department\GetDepartmentNaturalAreaResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetDepartmentNaturalAreaRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $departmentId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/Department/$this->departmentId/naturalareas";
    }

    /**
     * @return Listed<NaturalArea>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetDepartmentNaturalAreaResponse::make($response);
    }
}
