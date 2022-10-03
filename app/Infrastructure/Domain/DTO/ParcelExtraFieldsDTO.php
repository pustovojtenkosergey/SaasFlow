<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class ParcelExtraFieldsDTO
{

    public function __construct(
        public ?string $extra_field_1,
        public ?string $extra_field_2,
        public ?string $extra_field_3
    ) {
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            extra_field_1: Arr::get($data, 'extra_field_1', ''),
            extra_field_2: Arr::get($data, 'extra_field_2', ''),
            extra_field_3: Arr::get($data, 'extra_field_3', ''),
        );
    }
}
