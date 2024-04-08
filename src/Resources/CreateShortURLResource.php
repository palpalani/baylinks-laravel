<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Requests\ShortURL\CreateShortURLRequest;

final class CreateShortURLResource extends Resource
{
    /**
     * @return mixed|Account
     */
    public function post(string $access_token, array $data): mixed
    {
        return $this->connector->send(new CreateShortURLRequest($access_token, $data))->dto();
    }
}
