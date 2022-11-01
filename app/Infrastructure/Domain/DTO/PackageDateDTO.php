<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Carbon\Carbon;

class PackageDateDTO
{

    public function __construct(
        public string|Carbon|null $date,
        public string|Carbon|null $time_from,
        public string|Carbon|null $time_to
    )
{
    }

    public static function createFromValue(?string $data): self
    {
        $date = Carbon::parse($data)->toDateTimeString();
        return new self(
            date: $date,
            time_from: $date,
            time_to: $date,
        );
    }

}
