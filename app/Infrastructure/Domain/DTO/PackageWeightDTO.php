<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class PackageWeightDTO
{

    public function __construct(
        public ?float $weight_value,
        public ?string $weight_unit,
    ) {
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            weight_value: (float) Arr::get($data, 'weight_value'),
            weight_unit: Arr::get($data, 'weight_unit'),
        );
    }
}
