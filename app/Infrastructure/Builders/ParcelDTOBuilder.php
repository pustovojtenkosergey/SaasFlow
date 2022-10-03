<?php

declare(strict_types=1);


namespace App\Infrastructure\Builders;

use App\Infrastructure\Domain\DTO\ParcelAddressDto;
use App\Infrastructure\Domain\DTO\ParcelDTO;
use App\Infrastructure\Domain\DTO\ParcelItemDTO;
use App\Infrastructure\Domain\DTO\ParcelPackageDto;
use App\Infrastructure\Domain\DTO\ParcelServiceDTO;
use App\Infrastructure\Repo\AddressRepository;
use Illuminate\Support\Arr;
class ParcelDTOBuilder implements Builder
{

    public function __construct(private AddressRepository $addressRepository)
    {
    }

    public function build(array $data): ParcelDTO
    {
        $shipperAddress = null;
        if (null !== $shipperAddressFieldModel = $this->addressRepository->getRandByCountry(Arr::get($data, 'shipper_address.country', ''))) {
            $shipperAddress = ParcelAddressDto::createFromAddressFieldsModel($shipperAddressFieldModel);
        }

        $consigneeAddress = null;
        if (null !== $consigneeAddressFieldModel = $this->addressRepository->getRandByCountry(Arr::get($data, 'consignee_address.country', ''))) {
            $consigneeAddress = ParcelAddressDto::createFromAddressFieldsModel($consigneeAddressFieldModel);
        }

        $parcelItems = array_map(function ($item) {
            return ParcelItemDTO::createFromArray($item);
        }, Arr::get($data, 'parcel_items', []));


        return new ParcelDTO(
            is_test: (bool) Arr::get($data, 'is_test', true),
            shipper_id: (int) Arr::get($data, 'shipper_id'),
            service: ParcelServiceDTO::createFromArray(Arr::get($data, 'service', [])),
            package: ParcelPackageDto::createFromArray(Arr::get($data, 'package', [])),
            shipper_address: $shipperAddress,
            consignee_address: $consigneeAddress,
            parcel_items: $parcelItems
        );
    }
}
