<?php

namespace PalPalani\BayLinks\Responses\CategoryNaturalArea;

use PalPalani\BayLinks\Objects\CategoryNaturalArea;
use PalPalani\BayLinks\Objects\Listed;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type CategoryNaturalAreaData from CategoryNaturalArea
 */
final class GetAllCategoryNaturalAreaResponse
{
    /**
     * @return Listed<CategoryNaturalArea>
     */
    public static function make(Response $response): Listed
    {
        /** @var array<int, CategoryNaturalAreaData> $json */
        $json = $response->json();

        /** @var Listed<CategoryNaturalArea> $data */
        $data = Listed::from([
            'data' => array_map(fn ($categoryNaturalArea): CategoryNaturalArea => CategoryNaturalArea::from($categoryNaturalArea), $json),
        ]);

        return $data;
    }
}
