<?php

namespace App\Infrastructure\Repo;

use App\Infrastructure\Domain\DTO\PackageDto;
use App\Infrastructure\Services\TrackNumberGeneratorService;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PackageRepository
{

    public function __construct(
        private TrackNumberGeneratorService $trackNumberGeneratorService,
    ) {
    }

    public function getByIds(array $ids)
    {
        return Package::find($ids);
    }

    public function getListByRequest(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $data = $request->all();

        $query = Package::query();

        if (!empty($data['reference'])) {
            $query->where('reference', $data['reference']);
        }

        if (!empty($data['track_number'])) {
            $query->where('track_number', $data['track_number']);
        }

        if (!empty($data['created_from'])) {
            $query->whereDate('created_at','>=', Carbon::create($data['created_from'])->toDateString());
        }

        if (!empty($data['created_to'])) {
            $query->whereDate('created_at', '<=', Carbon::create($data['created_to'])->toDateString());
        }

        return $query->orderBy('created_at', 'desc')
                     ->paginate(intval($request->paginate ?? 50));
    }

    public function getByTrackNumber(string $trackNumber): ?Package
    {
        return Package::where('track_number', $trackNumber)->first();
    }

    public function create(PackageDto $packageDto)
    {
        return Package::create([
            'reference' => $packageDto->reference,
            'track_number' => $this->trackNumberGeneratorService->execute($packageDto),
            'contact_id' => $packageDto->contact->id,
            'data' => $packageDto->toDataJson(),
            'status' => Package::STATUS_CREATED
        ]);
    }
}
