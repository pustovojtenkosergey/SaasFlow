<?php

namespace App\Infrastructure\Services\InternalSaas;

use App\Infrastructure\Domain\DTO\PackageDto;
use App\Infrastructure\Repo\PackageRepository;
use App\Infrastructure\Services\LabelGeneratorService;
use App\Models\Package;

class InternalSaasCreatePackageService
{

    public function __construct(
        private PackageRepository $packageRepository,
        private LabelGeneratorService $labelGeneratorService,
    ) {
    }

    public function execute(PackageDto $packageDto): Package
    {
        $package = $this->packageRepository->create($packageDto);

        $this->labelGeneratorService->generate($package);

        return $package;
    }

}
