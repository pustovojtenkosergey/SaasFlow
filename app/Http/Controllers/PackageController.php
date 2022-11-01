<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Infrastructure\Helpers\FlowStorage;
use App\Infrastructure\Repo\CountryRepository;
use App\Infrastructure\Repo\PackageRepository;
use App\Infrastructure\Services\PackageCancelService;
use App\Infrastructure\Services\PackageStoreService;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function __construct(
        private CountryRepository $countryRepository,
        private PackageRepository $packageRepository,
    )
    {
    }

    public function index()
    {
        return view('packages.list');
    }

    public function fetchAll(Request $request)
    {
        $packages = $this->packageRepository->getListByRequest($request);

        return response()->json($packages);
    }


    public function create()
    {

        $locations = FlowStorage::getLocations();

        $services = collect([
            'Fedex', 'Hermes'
        ]);

        $currencies = collect(['USD', 'EUR']);

        $countries = $this->countryRepository->getCountriesCollection();

        return view('packages.create', [
            'from' => $locations['from'] ?? 'GB',
            'to' => $locations['to'] ?? 'SA',
            'services' => $services,
            'currencies' => $currencies,
            'countries' => $countries,
        ]);
    }

    public function store(StorePackageRequest $request, PackageStoreService $packageStoreService)
    {
        $reference = $packageStoreService->execute($request->all());

        return response()->json([
            'reference' => $reference,
        ]);
    }

    public function cancel(Package $package, PackageCancelService $packageCancelService)
    {
        return response()->json($packageCancelService->execute($package));
    }

    public function show(?Package $package)
    {
        if (null === $package) {
            throw new \HttpInvalidParamException('Package not found');
        }

        return view('packages.show')->with('package', $package);
    }
}
