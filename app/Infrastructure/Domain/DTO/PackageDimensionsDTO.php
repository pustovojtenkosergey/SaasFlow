<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class PackageDimensionsDTO
{

    public function __construct(
        public ?float $length,
        public ?float $width,
        public ?float $height,
        public ?string $dimensions_unit,
    ) {
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            length: (float) Arr::get($data, 'length'),
            width: (float) Arr::get($data, 'width'),
            height: (float) Arr::get($data, 'height'),
            dimensions_unit: Arr::get($data, 'dimensions_unit'),
        );
    }

}
