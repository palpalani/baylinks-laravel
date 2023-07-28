<?php

namespace PalPalani\BayLinks\Responses\NaturalArea;

use PalPalani\BayLinks\Objects\City;
use PalPalani\BayLinks\Objects\NaturalArea;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type NaturalAreaData from NaturalArea
 * @phpstan-import-type CityData from City
 */
final class GetNaturalAreaResponse
{
    public static function make(Response $response): NaturalArea
    {
        /** @var NaturalAreaData $data */
        $data = $response->json();

        return NaturalArea::from($data);
    }
}
