<?php

namespace Palpalani\BayLinks\Objects;

use Palpalani\BayLinks\Contracts\DataTransferObject;
use Saloon\Contracts\DataObjects\WithResponse;
use Saloon\Traits\Responses\HasResponse;

/**
 * @phpstan-type AccountData array{success: bool|null, code: int|null, locale: string|null, message: string|null, data: array|null}
 *
 * @implements DataTransferObject<AccountData>
 */
final class Account implements DataTransferObject, WithResponse
{
    use HasResponse;

    /**
     * @param  string[]|null  $languages
     * @param  string[]|null  $borders
     * @param  string[]|null  $flags
     */
    public function __construct(
        public readonly ?bool $success,
        public readonly ?int $code,
        public readonly ?string $locale,
        public readonly ?string $message,
        public readonly ?array $data,
    ) {
    }

    public static function from(array $data): Account
    {
        return new self(...$data);
    }
}
