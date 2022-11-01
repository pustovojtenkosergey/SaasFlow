<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PackageDetailsDto
{

    public function __construct(
        public ?int                  $number_of_piece,
        public ?string               $category,
        public ?bool                 $dangerous_goods,
        public ?string               $description,
        public ?string               $incoterm,
        public ?PackageValueDTO      $value,
        public ?PackageValueDTO      $cod,
        public ?PackageWeightDTO     $weight,
        public ?PackageDimensionsDTO $dimensions,
    ) {
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            number_of_piece: (int) Arr::get($data, 'number_of_piece', 1),
            category: Arr::get($data, 'category', 'other'),
            dangerous_goods: (bool) Arr::get($data, 'dangerous_goods'),
            description: Arr::get($data, 'description'),
            incoterm: Arr::get($data, 'incoterm'),
            value: PackageValueDTO::createFromArray(Arr::get($data, 'value', [])),
            cod: PackageValueDTO::createFromArray(Arr::get($data, 'cod', [])),
            weight: PackageWeightDTO::createFromArray(Arr::get($data, 'weight', [])),
            dimensions: PackageDimensionsDTO::createFromArray(Arr::get($data, 'dimensions', [])),
        );
    }
}
