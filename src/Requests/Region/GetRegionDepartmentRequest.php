<?php

namespace PalPalani\BayLinks\Requests\Region;

use PalPalani\BayLinks\Objects\Department;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Responses\Region\GetRegionDepartmentResponse;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class GetRegionDepartmentRequest extends Request
{
    use AlwaysThrowOnErrors;

    protected Method $method = Method::GET;

    public function __construct(protected int $regionId)
    {

    }

    public function resolveEndpoint(): string
    {
        return "/Region/$this->regionId/departments";
    }

    /**
     * @return Listed<Department>
     */
    public function createDtoFromResponse(Response $response): Listed
    {
        return GetRegionDepartmentResponse::make($response);
    }
}
