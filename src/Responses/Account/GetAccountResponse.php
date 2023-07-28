<?php

namespace PalPalani\BayLinks\Responses\Account;

use PalPalani\BayLinks\Objects\Account;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type AccountData from Account
 */
final class GetAccountResponse
{
    public static function make(Response $response): Account
    {
        /** @var AccountData $data */
        $data = $response->json();

        return new Account(...$data);
    }
}
