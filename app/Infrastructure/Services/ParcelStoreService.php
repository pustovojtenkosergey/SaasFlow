<?php

declare(strict_types=1);


namespace App\Infrastructure\Services;

use App\Infrastructure\Builders\ParcelDTOBuilder;
use App\Infrastructure\Domain\DTO\ParcelDTO;
use App\Jobs\CreateParcelJob;
use App\Models\Parcel;

class ParcelStoreService
{

    public function __construct(
        private ParcelDTOBuilder $parcelDTOBuilder,
    )
    {
    }

    public function execute(array $data): Parcel
    {
        $parcelDTO = $this->parcelDTOBuilder->build($data);

        $parcel = Parcel::create([
            'reference' => $this->generateReference($parcelDTO),
            'request_data' => json_encode($data),
            'status' => Parcel::STATUS_CREATED
        ]);

        CreateParcelJob::dispatch($parcel, $parcelDTO);

        $parcel->status = Parcel::STATUS_IN_QUEUE;
        $parcel->save();

        return $parcel;
    }

    private function generateReference(ParcelDTO $parcelDTO): string
    {
        return uniqid('parcel_' . $parcelDTO->shipper_address?->country . '-' . $parcelDTO->consignee_address?->country . '_');
    }
}
