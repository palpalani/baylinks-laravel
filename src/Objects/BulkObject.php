<?php

namespace PalPalani\BayLinks\Objects;

use PalPalani\BayLinks\Contracts\DataTransferObject;
use Saloon\Contracts\DataObjects\WithResponse;
use Saloon\Traits\Responses\HasResponse;

/**
 * @phpstan-type CountryData array{id: int, name: string|null, description: string|null, stateCapital: string|null, surface: int, population: int, languages: array<int, string>|null, timeZone: string|null, currency: string|null, currencyCode: string|null, currencySymbol: string|null, isoCode: string|null, internetDomain: string|null, phonePrefix: string|null, radioPrefix: string|null, aircraftPrefix: string|null, subRegion: string|null, region: string|null, borders: array<int, string>|null, flags: array<int,string>|null}
 *
 * @implements DataTransferObject<CountryData>
 */
final class BulkObject implements DataTransferObject, WithResponse
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
        public readonly ?int $count,
        public readonly ?array $data,
    ) {}

    public static function from(array $data): BulkObject
    {
        return new self(...$data);
    }
}
