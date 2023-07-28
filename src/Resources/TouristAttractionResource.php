<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Objects\TouristAttraction;
use PalPalani\BayLinks\Requests\TouristAttraction\GetAllTouristicAttractionRequest;
use PalPalani\BayLinks\Requests\TouristAttraction\GetPagedTouristicAttractionRequest;
use PalPalani\BayLinks\Requests\TouristAttraction\GetTouristicAttractionByNameRequest;
use PalPalani\BayLinks\Requests\TouristAttraction\GetTouristicAttractionBySearchRequest;
use PalPalani\BayLinks\Requests\TouristAttraction\GetTouristicAttractionRequest;

final class TouristAttractionResource extends Resource
{
    /**
     * @return mixed|Listed<TouristAttraction>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllTouristicAttractionRequest())->dto();
    }

    /**
     * @return mixed|TouristAttraction
     */
    public function get(int $touristicAttractionId): mixed
    {
        return $this->connector->send(new GetTouristicAttractionRequest($touristicAttractionId))->dto();
    }

    /**
     * @return mixed|Listed<TouristAttraction>
     */
    public function getByName(string $presidentName): mixed
    {
        return $this->connector->send(new GetTouristicAttractionByNameRequest($presidentName))->dto();
    }

    /**
     * @return mixed|Listed<TouristAttraction>
     */
    public function search(string $searchValue): mixed
    {
        return $this->connector->send(new GetTouristicAttractionBySearchRequest($searchValue))->dto();
    }

    /**
     * @return mixed|Paged<TouristAttraction>
     */
    public function paged(int $page, int $pageSize): mixed
    {
        return $this->connector->send(new GetPagedTouristicAttractionRequest($page, $pageSize))->dto();
    }
}
