<?php

namespace PalPalani\BayLinks\Responses\CategoryNaturalArea;

use PalPalani\BayLinks\Objects\CategoryNaturalArea;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type CategoryNaturalAreaData from CategoryNaturalArea
 */
final class GetCategoryNaturalAreaResponse
{
    public static function make(Response $response): CategoryNaturalArea
    {
        /** @var CategoryNaturalAreaData $data */
        $data = $response->json();

        return CategoryNaturalArea::from($data);
    }
}
