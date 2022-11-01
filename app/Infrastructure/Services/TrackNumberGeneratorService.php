<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Domain\DTO\PackageDto;
use App\Models\Package;

class TrackNumberGeneratorService
{

    const CONTACT_PAD = 7;
    const COUNTER_PAD = 12;

    public function execute(PackageDto $packageDto): string
    {
        return $packageDto->contact->country
            . str_pad((string)$packageDto->contact->id, self::CONTACT_PAD, '0', STR_PAD_LEFT)
            . str_pad((string)(intval(Package::orderBy('id', 'desc')->first()?->id) + 1), self::COUNTER_PAD, '0', STR_PAD_LEFT);
    }
}
