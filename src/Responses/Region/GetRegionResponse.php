<?php

namespace PalPalani\BayLinks\Responses\Region;

use PalPalani\BayLinks\Objects\Region;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type RegionData from Region
 */
final class GetRegionResponse
{
    public static function make(Response $response): Region
    {
        /** @var RegionData $data */
        $data = $response->json();

        return Region::from($data);
    }
}
