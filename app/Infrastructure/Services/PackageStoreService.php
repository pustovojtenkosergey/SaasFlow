<?php

declare(strict_types=1);


namespace App\Infrastructure\Services;

use App\Infrastructure\Builders\ContactDataBuilder;
use App\Infrastructure\Builders\PackageDataBuilder;
use App\Infrastructure\Services\InternalSaas\InternalSaasCreatePackageService;
use App\Jobs\CreatePackageJob;
use Illuminate\Support\Arr;

class PackageStoreService
{

    public function __construct(
        private ContactDataBuilder $contactDataBuilder,
        private ContactStoreService $contactStoreService,
        private PackageDataBuilder  $packageDataBuilder,
        private InternalSaasCreatePackageService $internalSaasCreatePackageService,
    ) {
    }

    public function execute(array $data): string
    {
        $contactData = $this->contactDataBuilder->build(Arr::get($data, 'contact'));

        $packageData = $this->packageDataBuilder->build(
            uniqid(time() . '_'),
            $data,
            $this->contactStoreService->execute($contactData)
        );

        $this->internalSaasCreatePackageService->execute($packageData);

//        CreatePackageJob::dispatch($packageData);

        return $packageData->reference;

//        FlowStorage::setLocations([
//            'from' => $parcelDTO->shipper_address?->country,
//            'to' => $parcelDTO->consignee_address?->country,
//        ]);
    }
}
