<?php

namespace PalPalani\BayLinks\Responses\TouristAttraction;

use PalPalani\BayLinks\Objects\TouristAttraction;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type TouristAttractionData from TouristAttraction
 */
final class GetTouristicAttractionResponse
{
    public static function make(Response $response): TouristAttraction
    {
        /** @var TouristAttractionData $data */
        $data = $response->json();

        return TouristAttraction::from($data);
    }
}
