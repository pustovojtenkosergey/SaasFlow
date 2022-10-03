<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

use Illuminate\Support\Arr;

class ParcelPackageDto
{

    public function __construct(
        public ?int $number_of_piece,
        public ?string $order_reference,
        public ?string $customer_id_reference,
        public ?string $rgr_number,
        public ?string $category,
        public ?bool $dangerous_goods,
        public ?string $incoterm,
        public ?string $invoice_number,
        public ?string $description,
        public ?string $courier_instruction,
        public ?string $non_delivery_instruction,
        public ?bool $pod_signature_required,
        public ?ParcelValueDTO $value,
        public ?ParcelValueDTO $cod,
        public ?ParcelWeightDTO $weight,
        public ?ParcelDimensionsDTO $dimensions,
        public ?ParcelExtraFieldsDTO $extra_fields,
    ) {
    }

//                "customer_id_reference" => $st_order_refence,
//                "rgr_number" => "ID123",
//                "category" => "gifts",
//                "dangerous_goods" => false,
//                "incoterm" => "DDP",
//                "invoice_number" => "IN123",
//                "description" => "test description",
//                "courier_instruction" => "Test parcel",
//                "non_delivery_instruction" => "Test parcel",
//                "pod_signature_required" => true,


    public static function createFromArray(array $data): self
    {

        return new self(
            number_of_piece: (int) Arr::get($data, 'number_of_piece', 1),
            order_reference: Arr::get($data, 'order_reference'),
            customer_id_reference: Arr::get($data, 'customer_id_reference'),
            rgr_number: Arr::get($data, 'rgr_number', 'ID123'),
            category: Arr::get($data, 'category', 'other'),
            dangerous_goods: (bool) Arr::get($data, 'dangerous_goods'),
            incoterm: Arr::get($data, 'incoterm', 'DDP'),
            invoice_number: Arr::get($data, 'invoice_number', 'IN123'),
            description: Arr::get($data, 'description', 'Test parcel'),
            courier_instruction: Arr::get($data, 'courier_instruction'),
            non_delivery_instruction: Arr::get($data, 'non_delivery_instruction'),
            pod_signature_required: true,
            value: ParcelValueDTO::createFromArray(Arr::get($data, 'value', [])),
            cod: ParcelValueDTO::createFromArray(Arr::get($data, 'cod', [])),
            weight: ParcelWeightDTO::createFromArray(Arr::get($data, 'weight', [])),
            dimensions: ParcelDimensionsDTO::createFromArray(Arr::get($data, 'dimensions', [])),
            extra_fields: ParcelExtraFieldsDTO::createFromArray(Arr::get($data, 'extra_fields', []))
        );
    }
}
