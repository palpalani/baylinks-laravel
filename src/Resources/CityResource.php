<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Requests\City\GetAllCityRequest;
use PalPalani\BayLinks\Requests\City\GetCityByNameRequest;
use PalPalani\BayLinks\Requests\City\GetCityBySearchRequest;
use PalPalani\BayLinks\Requests\City\GetCityRequest;
use PalPalani\BayLinks\Requests\City\GetPagedCityRequest;

final class CityResource extends Resource
{
    /**
     * @return mixed|Listed<City>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllCityRequest())->dto();
    }

    /**
     * @return mixed|City
     */
    public function get(int $cityId): mixed
    {
        return $this->connector->send(new GetCityRequest($cityId))->dto();
    }

    /**
     * @return mixed|Listed<City>
     */
    public function getByName(string $cityName): mixed
    {
        return $this->connector->send(new GetCityByNameRequest($cityName))->dto();
    }

    /**
     * @return mixed|Listed<City>
     */
    public function search(string $searchValue): mixed
    {
        return $this->connector->send(new GetCityBySearchRequest($searchValue))->dto();
    }

    /**
     * @return mixed|Paged<City>
     */
    public function paged(int $page, int $pageSize): mixed
    {
        return $this->connector->send(new GetPagedCityRequest($page, $pageSize))->dto();
    }
}
