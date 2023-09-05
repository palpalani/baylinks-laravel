<?php

namespace PalPalani\BayLinks\Requests\ShortURL;

use PalPalani\BayLinks\Objects\Account;
use PalPalani\BayLinks\Responses\ShortURL\ShortUrlVisitRecordResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class ShortUrlVisitRecordRequest extends Request implements HasBody
{
    use AlwaysThrowOnErrors;
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected array $data = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return '/links/short-url-payload';
    }

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): Account
    {
        return ShortUrlVisitRecordResponse::make($response);
    }
}
