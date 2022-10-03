<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;


class ParcelDTO extends DataTransferObject
{

    public function __construct(
        public bool $is_test = true,
        public ?int $shipper_id = null,
        public ?ParcelServiceDTO $service = null,
        public ?ParcelPackageDto $package = null,
        public ?ParcelAddressDto $shipper_address = null,
        public ?ParcelAddressDto $consignee_address = null,
        public array $parcel_items = []
    ) {
    }
}
