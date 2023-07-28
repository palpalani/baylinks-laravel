<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Requests\Account\GetAccountRequest;

final class AccountResource extends Resource
{
    /**
     * @return mixed|Account
     */
    public function get(string $country): mixed
    {
        return $this->connector->send(new GetAccountRequest($country))->dto();
    }
}
