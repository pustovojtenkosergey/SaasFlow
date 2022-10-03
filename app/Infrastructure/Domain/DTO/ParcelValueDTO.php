<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class ParcelValueDTO
{

    public function __construct(
        public ?float $amount,
        public ?string $currency,
    ) {
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            amount: Arr::get($data, 'amount', 0),
            currency: Arr::get($data, 'currency', 'USD'),
        );
    }

}
