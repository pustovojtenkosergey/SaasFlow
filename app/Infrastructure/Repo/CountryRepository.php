<?php

declare(strict_types=1);


namespace App\Infrastructure\Repo;

use Illuminate\Support\Collection;
use League\ISO3166\ISO3166;

class CountryRepository
{
    public const FIX_NAME_MAP = [
        "GB" => "United Kingdom",
    ];

    public function getCountriesCollection(bool $fixed = true): Collection
    {
        $countries = (new ISO3166())->all();
        $data = $fixed ? array_map(fn($v) => $this->fixName($v), $countries) : $countries;

        return (new Collection($data))->pluck('name', 'alpha2');
    }

    private function fixName(array $v): array
    {
        if ($newName = (static::FIX_NAME_MAP[$v['alpha2']] ?? null)) {
            $v['name'] = $newName;
        }

        return $v;
    }

    public function getNameByAlpha2(string $alpha2): ?string
    {
        return (new ISO3166())->alpha2($alpha2)['name'] ?? null;
    }
}
