<?php

namespace App\Http\Controllers;

use App\Infrastructure\Repo\PackageRepository;
use Illuminate\Http\Request;

class PackageGroupController extends Controller
{

    public function __construct(
        private PackageRepository $packageRepository
    ) {
    }

    public function create(Request $request)
    {

        $packages = [];
        if ($request->isMethod('POST')) {
            $packages = $this->packageRepository->getByIds($request->packages ?? []);
        }

        return view('package_groups.create', [
            'packages' => $packages
        ]);
    }
}
