<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Map;
use PalPalani\BayLinks\Requests\Map\GetAllMapRequest;
use PalPalani\BayLinks\Requests\Map\GetMapRequest;

final class MapResource extends Resource
{
    /**
     * @return mixed|Listed<Map>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllMapRequest())->dto();
    }

    /**
     * @return mixed|Map
     */
    public function get(int $mapId): mixed
    {
        return $this->connector->send(new GetMapRequest($mapId))->dto();
    }
}
