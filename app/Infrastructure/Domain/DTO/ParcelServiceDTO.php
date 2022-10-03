<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class ParcelServiceDTO
{

    public function __construct(
        public ?string $service_id,
        public ?string $pudo_id,
        public ?string $label_format,
        public ?string $label_type,
        public ?string $label_template,
        public ?string $display_id,
        public ?ParcelValueDTO $shipping_cost,
        public ?ParcelDateDTO $collection_date,
        public ?ParcelDateDTO $delivery_date,
    ) {

    }

    public static function createFromArray(array $data): self
    {
        return new self(
            service_id: Arr::get($data, 'service_id'),
            pudo_id: (string)Arr::get($data, 'pudo_id'),
            label_format: Arr::get($data, 'label_format', 'PDF'),
            label_type: Arr::get($data, 'label_type', 'system'),
            label_template: '',
            display_id: '',
            shipping_cost: ParcelValueDTO::createFromArray(Arr::get($data, 'shipping_cost', [])),
            collection_date: ParcelDateDTO::createFromValue(Arr::get($data, 'collection_date')),
            delivery_date: ParcelDateDTO::createFromValue(Arr::get($data, 'delivery_date'))
        );
    }
}
