<?php

namespace PalPalani\BayLinks\Responses\President;

use PalPalani\BayLinks\Objects\Paged;
use PalPalani\BayLinks\Objects\President;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type PagedData from Paged
 */
final class GetPagedPresidentResponse
{
    /**
     * TODO: fix workaround for phpstan
     *
     * @return Paged<President>
     */
    public static function make(Response $response): Paged
    {
        /** @var PagedData $data */
        $data = $response->json();

        /** @var Paged<President> $paginated */
        $paginated = Paged::from(array_merge($data, [
            'data' => is_null($data['data'])
                ? []
                : array_map(fn ($president): President => President::from($president), $data['data']),
        ]));

        return $paginated;
    }
}
