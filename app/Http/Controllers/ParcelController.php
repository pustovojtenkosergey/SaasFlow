<?php

namespace App\Http\Controllers;

use App\Infrastructure\Repo\CountryRepository;
use App\Infrastructure\Services\ParcelStoreService;
use App\Models\Parcel;
use Illuminate\Http\Request;;

class ParcelController extends Controller
{

    public function __construct(
        private CountryRepository $countryRepository
    )
    {
    }

    public function index()
    {
        return view('parcels.list');
    }

    public function fetchParcels()
    {
        $parcels = Parcel::orderBy('created_at', 'desc')->get()
            ->map(function (Parcel $parcel) {
               return [
                   'id' => $parcel->id,
                   'reference' => $parcel->reference,
                   'tracker_number' => $parcel->track_number,
                   'created_at' => $parcel->created_at,
                   'link' => route('parcels.show', ['parcel' => $parcel]),
                   'status' => [
                       'name' => $parcel->getStatusName(),
                       'color' => $parcel->getStatusColor(),
                   ]

               ];
            });

        return response()->json($parcels);
    }


    public function create()
    {
        $users = collect([
            ['id' => 16, 'name' => 'Shipper Test',],
//            ['id' => 18, 'name' => 'Shipper Test2',],
//            ['id' => 20, 'name' => 'Shipper bla',]
        ]);

        $services = collect([
            'SLG001',
//            'SLG003',
//            'SLG008'
        ]);

        $labelFormats = collect(['pdf', 'zpl200', 'zpl300']);

        $currencies = collect(['USD', 'EUR', 'UAH']);

        $countries = $this->countryRepository->getCountriesCollection();

        return view('parcels.create', [
            'users' => $users,
            'services' => $services,
            'labelFormats' => $labelFormats,
            'currencies' => $currencies,
            'countries' => $countries,
        ]);
    }

    public function store(Request $request, ParcelStoreService $parcelStoreService)
    {
        $parcel = $parcelStoreService->execute($request->all());

        return response()->json([
            'parcel_id' => $parcel->id,
            'reference' => $parcel->reference,
        ]);
    }

    public function show(?Parcel $parcel)
    {
        return view('parcels.show')->with('parcel', $parcel);
    }
}
