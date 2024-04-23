<?php

namespace PalPalani\BayLinks\Responses\ShortURL;

use PalPalani\BayLinks\Objects\Account;
use Saloon\Http\Response;

/**
 * @phpstan-import-type AccountData from Account
 */
final class GetShortURLResponse
{
    public static function make(Response $response): Account
    {
        /** @var AccountData $data */
        $data = $response->json();

        return new Account(...$data);
    }
}
