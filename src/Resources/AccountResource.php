<?php

namespace Palpalani\BayLinks\Resources;

use Palpalani\BayLinks\Objects\Account;
use Palpalani\BayLinks\Requests\Account\GetAccountRequest;

final class AccountResource extends Resource
{
    /**
     * @return mixed|Account
     */
    public function get(): mixed
    {
        return $this->connector->send(new GetAccountRequest())->dto();
    }
}
