<?php

namespace Palpalani\BayLinks\Responses\Action;

use Palpalani\BayLinks\Objects\Account;
use Saloon\Contracts\Response;

/**
 * @phpstan-import-type ActionData from Action
 */
final class GetGenerateLinkResponse
{
    public static function make(Response $response): Account
    {
        /** @var ActionData $data */
        $data = $response->json();

        return new Action(...$data);
    }
}
