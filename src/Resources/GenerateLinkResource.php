<?php

namespace Palpalani\BayLinks\Resources;

use Palpalani\BayLinks\Objects\GenerateLink;
use Palpalani\BayLinks\Requests\Account\GenerateLinkRequest;

final class GenerateLinkResource extends Resource
{
    /**
     * @return mixed|GenerateLink
     */
    public function post(array $data): mixed
    {
        return $this->connector->send(new GenerateLinkRequest($data))->dto();
    }
}
