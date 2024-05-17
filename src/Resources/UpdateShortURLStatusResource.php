<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Requests\ShortURL\UpdateShortURLStatusRequest;

final class UpdateShortURLStatusResource extends Resource
{
    /**
     * @return mixed|Account
     */
    public function post(string $access_token, array $data): mixed
    {
        return $this->connector->send(new UpdateShortURLStatusRequest($access_token, $data))->dto();
    }
}
