<?php

namespace App\Jobs;

use App\Events\PackageCreated;
use App\Infrastructure\Domain\DTO\PackageDto;
use App\Infrastructure\Services\InternalSaas\InternalSaasCreatePackageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatePackageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private PackageDto $packageDto
    ){
    }

    /**
     * @param InternalSaasCreatePackageService $internalSaasCreatePackageService
     * @return void
     */
    public function handle(InternalSaasCreatePackageService $internalSaasCreatePackageService): void
    {
        $package = $internalSaasCreatePackageService->execute($this->packageDto);
        broadcast(new PackageCreated($package));
    }
}
