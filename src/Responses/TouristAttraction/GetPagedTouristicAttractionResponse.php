<?php

namespace PalPalani\BayLinks\Responses\TouristAttraction;

use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Objects\TouristAttraction;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type PagedData from Paged
 */
final class GetPagedTouristicAttractionResponse
{
    /**
     * TODO: fix workaround for phpstan
     *
     * @return Paged<TouristAttraction>
     */
    public static function make(Response $response): Paged
    {
        /** @var PagedData $data */
        $data = $response->json();

        /** @var Paged<TouristAttraction> $paginated */
        $paginated = Paged::from(array_merge($data, [
            'data' => is_null($data['data'])
                ? []
                : array_map(fn ($touristicAttraction): TouristAttraction => TouristAttraction::from($touristicAttraction), $data['data']),
        ]));

        return $paginated;
    }
}
