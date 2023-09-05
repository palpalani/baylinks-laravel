<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Requests\ShortURL\ShortUrlVisitRecordRequest;

final class ShortUrlVisitRecordResource extends Resource
{
    /**
     * @return mixed|Account
     */
    public function post(array $data): mixed
    {
        return $this->connector->send(new ShortUrlVisitRecordRequest($data))->dto();
    }
}
