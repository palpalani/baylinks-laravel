<?php

namespace PalPalani\BayLinks\Requests\ShortURL;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Responses\ShortURL\GetShortURLResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Traits\Body\HasJsonBody;

final class CreateShortURLRequest extends Request implements HasBody
{
    use AlwaysThrowOnErrors;
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected array $data = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return '/links';
    }

    public function defaultBody(): array
    {
        return $this->data;
    }

    /**
     * @return Account
     */
    public function createDtoFromResponse(Response $response): Account
    {
        return GetShortURLResponse::make($response);
    }
}
