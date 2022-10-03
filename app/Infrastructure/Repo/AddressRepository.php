<?php

declare(strict_types=1);


namespace App\Infrastructure\Repo;

use App\Models\AddressField;

class AddressRepository
{

    public function getRandByCountry(string $country): ?AddressField
    {
        return AddressField::where('country', $country)->inRandomOrder()->get()->first();
    }
}
