<?php

declare(strict_types=1);


namespace App\Infrastructure\Helpers;

use Illuminate\Support\Facades\Redis;

class FlowStorage
{

    private const EXPIRE_TIME = 3600;

    public static function setFlow(string $reference, string $value): void
    {
        Redis::set($reference, $value, 'EX', self::EXPIRE_TIME);
    }

    public static function getFlow(string $reference): ?string
    {
        return Redis::get($reference);
    }

    public static function getAll(): array
    {
        $list = Redis::keys('*');

        $result = [];

        foreach ($list as $key) {
            $data = self::getFlow(str_replace(config('database.redis.options.prefix'), '', $key));
            if (empty($data)) {
                continue;
            }
            if (!empty($data = json_decode($data, true))) {
                $result[$key] = $data;
            }
        }

        return $result;
    }

    public static function setLocations(array $locations): void
    {
        Redis::set('last_locations', json_encode($locations));
    }

    public static function getLocations(): array
    {
        $locations = Redis::get('last_locations');
        if (empty($locations))
            return [];

        return json_decode($locations, true);
    }

}
