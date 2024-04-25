<?php

namespace PalPalani\BayLinks\Responses\ShortURL;

use PalPalani\BayLinks\Objects\BulkObject;
use Saloon\Http\Response;

/**
 * @phpstan-import-type AccountData from BulkObject
 */
final class GetBulkURLResponse
{
    public static function make(Response $response): BulkObject
    {
        /** @var AccountData $data */
        $data = $response->json();

        return new BulkObject(...$data);
    }
}
