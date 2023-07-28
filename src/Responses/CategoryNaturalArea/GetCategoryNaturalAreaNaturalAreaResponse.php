<?php

namespace PalPalani\BayLinks\Responses\CategoryNaturalArea;

use PalPalani\BayLinks\Objects\CategoryNaturalArea;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type CategoryNaturalAreaData from CategoryNaturalArea
 */
final class GetCategoryNaturalAreaNaturalAreaResponse
{
    /**
     * @return Listed<NaturalArea>
     */
    public static function make(Response $response): Listed
    {
        /** @var CategoryNaturalAreaData $json */
        $json = $response->json();
        $naturalAreas = $json['naturalAreas'] ?? [];

        /** @var Listed<NaturalArea> $data */
        $data = Listed::from([
            'data' => array_map(fn ($naturalArea): NaturalArea => NaturalArea::from($naturalArea), $naturalAreas),
        ]);

        return $data;
    }
}
