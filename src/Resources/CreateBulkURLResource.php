<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\BulkObject;
use PalPalani\BayLinks\Requests\ShortURL\CreateBulkURLRequest;

final class CreateBulkURLResource extends Resource
{
    /**
     * @return mixed|BulkObject
     */
    public function post(string $access_token, array $data): mixed
    {
        return $this->connector->send(new CreateBulkURLRequest($access_token, $data))->dto();
    }
}
