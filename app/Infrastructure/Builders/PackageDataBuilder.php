<?php

declare(strict_types=1);


namespace App\Infrastructure\Builders;

use App\Infrastructure\Domain\DTO\PackageDto;
use App\Infrastructure\Domain\DTO\PackageItemDTO;
use App\Infrastructure\Domain\DTO\PackageDetailsDto;
use App\Infrastructure\Domain\DTO\PackageServiceDTO;
use App\Models\Contact;
use Illuminate\Support\Arr;

class PackageDataBuilder
{

    public function build(string $reference, array $data, Contact $contact = null): PackageDto
    {
        return new PackageDto(
            is_test: (bool) Arr::get($data, 'is_test', true),
            reference: $reference,
            contact: $contact,
            service: PackageServiceDTO::createFromArray(Arr::get($data, 'service', [])),
            details: PackageDetailsDto::createFromArray(Arr::get($data, 'details', [])),
            items: array_map(function ($item) {
                return PackageItemDTO::createFromArray($item);
            }, Arr::get($data, 'items', []))
        );
    }
}
