<?php

namespace PalPalani\BayLinks\Responses\City;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\Listed;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type CityData from City
 */
final class GetAllCityResponse
{
    /**
     * @return Listed<City>
     */
    public static function make(Response $response): Listed
    {
        /** @var CityData[] $json */
        $json = $response->json();

        /** @var Listed<City> $data */
        $data = Listed::from([
            'data' => array_map(fn ($city): City => City::from($city), $json),
        ]);

        return $data;
    }
}
