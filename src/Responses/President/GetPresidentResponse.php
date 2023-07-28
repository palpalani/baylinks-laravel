<?php

namespace PalPalani\BayLinks\Responses\President;

use PalPalani\BayLinks\Objects\President;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type PresidentData from President
 */
final class GetPresidentResponse
{
    public static function make(Response $response): President
    {
        /** @var PresidentData $data */
        $data = $response->json();

        return President::from($data);
    }
}
