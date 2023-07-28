<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Requests\NaturalArea\GetAllNaturalAreaRequest;
use PalPalani\BayLinks\Requests\NaturalArea\GetNaturalAreaByNameRequest;
use PalPalani\BayLinks\Requests\NaturalArea\GetNaturalAreaBySearchRequest;
use PalPalani\BayLinks\Requests\NaturalArea\GetNaturalAreaRequest;
use PalPalani\BayLinks\Requests\NaturalArea\GetPagedNaturalAreaRequest;

final class NaturalAreaResource extends Resource
{
    /**
     * @return mixed|Listed<NaturalArea>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllNaturalAreaRequest())->dto();
    }

    /**
     * @return mixed|NaturalArea
     */
    public function get(int $naturalAreaId): mixed
    {
        return $this->connector->send(new GetNaturalAreaRequest($naturalAreaId))->dto();
    }

    /**
     * @return mixed|Listed<NaturalArea>
     */
    public function getByName(string $naturalAreaName): mixed
    {
        return $this->connector->send(new GetNaturalAreaByNameRequest($naturalAreaName))->dto();
    }

    /**
     * @return mixed|Listed<NaturalArea>
     */
    public function search(string $searchValue): mixed
    {
        return $this->connector->send(new GetNaturalAreaBySearchRequest($searchValue))->dto();
    }

    /**
     * @return mixed|Paged<NaturalArea>
     */
    public function paged(int $page, int $pageSize): mixed
    {
        return $this->connector->send(new GetPagedNaturalAreaRequest($page, $pageSize))->dto();
    }
}
