<?php

namespace PalPalani\BayLinks\Requests\ShortURL;

use PalPalani\BayLinks\Objects\BulkObject;
use PalPalani\BayLinks\Responses\ShortURL\GetBulkURLResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class CreateBulkURLRequest extends Request implements HasBody
{
    use AlwaysThrowOnErrors;
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected string $access_token, protected array $data = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return '/links/bulk';
    }

    public function defaultBody(): array
    {
        return $this->data;
    }

    protected function defaultHeaders(): array
    {
        return [
            'X-Api-Key' => $this->access_token,
        ];
    }

    public function createDtoFromResponse(Response $response): BulkObject
    {
        return GetBulkURLResponse::make($response);
    }
}
