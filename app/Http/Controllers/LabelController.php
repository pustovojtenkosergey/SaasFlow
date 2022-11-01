<?php

namespace App\Http\Controllers;

use App\Infrastructure\Repo\PackageRepository;
use Illuminate\Support\Facades\Storage;

class LabelController extends Controller
{

    public function __construct(
        private PackageRepository $packageRepository
    )
    {
    }

    public function get(string $trackNumber)
    {
        $package = $this->packageRepository->getByTrackNumber($trackNumber);

        if (null === $package) {
            return null;
        }

        return response()->file(Storage::disk('labels')->path($package->label));
    }

    public function download(string $trackNumber)
    {
        $package = $this->packageRepository->getByTrackNumber($trackNumber);

        if (null === $package) {
            return null;
        }

        return response()->download(Storage::disk('labels')->path($package->label));
    }


}
