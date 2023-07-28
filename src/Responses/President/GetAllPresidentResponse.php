<?php

namespace PalPalani\BayLinks\Responses\President;

use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\President;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type PresidentData from President
 */
final class GetAllPresidentResponse
{
    /**
     * @return Listed<President>
     */
    public static function make(Response $response): Listed
    {
        /** @var array<int, PresidentData> $json */
        $json = $response->json();

        /** @var Listed<President> $data */
        $data = Listed::from([
            'data' => array_map(fn ($president): President => President::from($president), $json),
        ]);

        return $data;
    }
}
