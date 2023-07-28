<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Department;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Region;
use PalPalani\BayLinks\Requests\Region\GetAllRegionRequest;
use PalPalani\BayLinks\Requests\Region\GetRegionDepartmentRequest;
use PalPalani\BayLinks\Requests\Region\GetRegionRequest;

final class RegionResource extends Resource
{
    /**
     * @return mixed|Listed<Region>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllRegionRequest())->dto();
    }

    /**
     * @return mixed|Region
     */
    public function get(int $regionId): mixed
    {
        return $this->connector->send(new GetRegionRequest($regionId))->dto();
    }

    /**
     * @return mixed|Listed<Department>
     */
    public function departments(int $regionId): mixed
    {
        return $this->connector->send(new GetRegionDepartmentRequest($regionId))->dto();
    }
}
