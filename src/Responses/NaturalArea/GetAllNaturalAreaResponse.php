<?php

namespace PalPalani\BayLinks\Responses\NaturalArea;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type NaturalAreaData from NaturalArea
 */
final class GetAllNaturalAreaResponse
{
    /**
     * @return Listed<NaturalArea>
     */
    public static function make(Response $response): Listed
    {
        /** @var NaturalAreaData[] $json */
        $json = $response->json();

        /** @var Listed<NaturalArea> $data */
        $data = Listed::from([
            'data' => array_map(fn ($naturalArea): NaturalArea => NaturalArea::from($naturalArea), $json),
        ]);

        return $data;
    }
}
