<?php

declare(strict_types=1);


namespace App\Infrastructure\Services;

use App\Models\Package;

class PackageCancelService
{

    public function __construct(
        private LabelGeneratorService $labelGeneratorService
    )
    {
    }

    public function execute(Package $package): bool
    {
        $this->labelGeneratorService->markCanceled($package);

        $package->status = Package::STATUS_CANCELED;
        $package->save();

        return true;
    }
}
