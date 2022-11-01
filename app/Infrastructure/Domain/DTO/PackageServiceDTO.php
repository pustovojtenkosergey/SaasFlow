<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class PackageServiceDTO
{

    public function __construct(
        public ?string          $service_id,
        public ?string          $label_format,
        public ?PackageValueDTO $shipping_cost,
        public ?PackageDateDTO  $collection_date,
        public ?PackageDateDTO  $delivery_date,
    ) {

    }

    public static function createFromArray(array $data): self
    {
        return new self(
            service_id: Arr::get($data, 'service_id'),
            label_format: Arr::get($data, 'label_format', 'PDF'),
            shipping_cost: PackageValueDTO::createFromArray(Arr::get($data, 'shipping_cost', [])),
            collection_date: PackageDateDTO::createFromValue(Arr::get($data, 'collection_date')),
            delivery_date: PackageDateDTO::createFromValue(Arr::get($data, 'delivery_date'))
        );
    }
}
