<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Objects\President;
use PalPalani\BayLinks\Requests\President\GetAllPresidentRequest;
use PalPalani\BayLinks\Requests\President\GetPagedPresidentRequest;
use PalPalani\BayLinks\Requests\President\GetPresidentByNameRequest;
use PalPalani\BayLinks\Requests\President\GetPresidentBySearchRequest;
use PalPalani\BayLinks\Requests\President\GetPresidentRequest;

final class PresidentResource extends Resource
{
    /**
     * @return mixed|Listed<President>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllPresidentRequest())->dto();
    }

    /**
     * @return mixed|President
     */
    public function get(int $presidentId): mixed
    {
        return $this->connector->send(new GetPresidentRequest($presidentId))->dto();
    }

    /**
     * @return mixed|Listed<President>
     */
    public function getByName(string $presidentName): mixed
    {
        return $this->connector->send(new GetPresidentByNameRequest($presidentName))->dto();
    }

    /**
     * @return mixed|Listed<President>
     */
    public function search(string $searchValue): mixed
    {
        return $this->connector->send(new GetPresidentBySearchRequest($searchValue))->dto();
    }

    /**
     * @return mixed|Paged<President>
     */
    public function paged(int $page, int $pageSize): mixed
    {
        return $this->connector->send(new GetPagedPresidentRequest($page, $pageSize))->dto();
    }
}
