<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\Department;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Objects\TouristAttraction;
use PalPalani\BayLinks\Requests\Department\GetAllDepartmentRequest;
use PalPalani\BayLinks\Requests\Department\GetDepartmentByNameRequest;
use PalPalani\BayLinks\Requests\Department\GetDepartmentBySearchRequest;
use PalPalani\BayLinks\Requests\Department\GetDepartmentCityRequest;
use PalPalani\BayLinks\Requests\Department\GetDepartmentNaturalAreaRequest;
use PalPalani\BayLinks\Requests\Department\GetDepartmentRequest;
use PalPalani\BayLinks\Requests\Department\GetDepartmentTouristAttractionRequest;
use PalPalani\BayLinks\Requests\Department\GetPagedDepartmentRequest;

final class DepartmentResource extends Resource
{
    /**
     * @return mixed|Listed<Department>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllDepartmentRequest())->dto();
    }

    /**
     * @return mixed|Department
     */
    public function get(int $departmentId): mixed
    {
        return $this->connector->send(new GetDepartmentRequest($departmentId))->dto();
    }

    /**
     * @return mixed|Listed<Department>
     */
    public function getByName(string $departmentName): mixed
    {
        return $this->connector->send(new GetDepartmentByNameRequest($departmentName))->dto();
    }

    /**
     * @return mixed|Listed<Department>
     */
    public function search(string $searchValue): mixed
    {
        return $this->connector->send(new GetDepartmentBySearchRequest($searchValue))->dto();
    }

    /**
     * @return mixed|Paged<Department>
     */
    public function paged(int $page, int $pageSize): mixed
    {
        return $this->connector->send(new GetPagedDepartmentRequest($page, $pageSize))->dto();
    }

    /**
     * @return mixed|Listed<City>
     */
    public function cities(int $departmentId): mixed
    {
        return $this->connector->send(new GetDepartmentCityRequest($departmentId))->dto();
    }

    /**
     * @return mixed|Listed<NaturalArea>
     */
    public function naturalAreas(int $departmentId): mixed
    {
        return $this->connector->send(new GetDepartmentNaturalAreaRequest($departmentId))->dto();
    }

    /**
     * @return mixed|Listed<TouristAttraction>
     */
    public function touristAttractions(int $departmentId): mixed
    {
        return $this->connector->send(new GetDepartmentTouristAttractionRequest($departmentId))->dto();
    }
}
