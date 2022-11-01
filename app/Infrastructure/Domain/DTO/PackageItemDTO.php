<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class PackageItemDTO
{

    public function __construct(
        public ?int             $quantity,
        public ?string          $description,
        public ?PackageValueDTO $value,
        public ?string          $country_of_origin,
        public ?string          $sku,
        public ?string          $hs_code,
    ) {
    }

    public static function createFromArray(array $data): self
    {

        return new self(
            quantity: Arr::get($data, 'quantity', 1),
            description: Arr::get($data, 'description'),
            value: PackageValueDTO::createFromArray([
                'amount' => Arr::get($data, 'value_amount'),
                'currency' => Arr::get($data, 'extra.value_currency'),
            ]),
            country_of_origin: Arr::get($data, 'extra.country_of_origin'),
            sku: Arr::get($data, 'sku'),
            hs_code: Arr::get($data, 'hs_code'),
        );
    }

}
