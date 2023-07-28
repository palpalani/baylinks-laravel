<?php

namespace PalPalani\BayLinks\Responses\Map;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\Map;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type MapData from Map
 * @phpstan-import-type CityData from City
 */
final class GetAllMapResponse
{
    /**
     * @return Listed<Map>
     */
    public static function make(Response $response): Listed
    {
        /** @var MapData[] $json */
        $json = $response->json();

        /** @var Listed<Map> $data */
        $data = Listed::from([
            'data' => array_map(fn ($map): Map => Map::from($map), $json),
        ]);

        return $data;
    }
}
