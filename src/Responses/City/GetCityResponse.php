<?php

namespace PalPalani\BayLinks\Responses\City;

use PalPalani\BayLinks\Objects\City;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type CityData from City
 */
final class GetCityResponse
{
    public static function make(Response $response): City
    {
        /** @var CityData $data */
        $data = $response->json();

        return City::from($data);
    }
}
