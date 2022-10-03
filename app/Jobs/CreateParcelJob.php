<?php

namespace App\Jobs;

use App\Events\ParcelCreated;
use App\Infrastructure\Domain\DTO\ParcelDTO;
use App\Infrastructure\Services\Saas\Api\SaasApiCreateParcelService;
use App\Models\Parcel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateParcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Parcel $parcel, private ParcelDTO $parcelDTO)
    {
    }

    /**
     * Execute the job.
     *
     * @param  SaasApiCreateParcelService  $saasApiCreateParcelService
     * @return void
     */
    public function handle(SaasApiCreateParcelService $saasApiCreateParcelService): void
    {
        $this->parcel->status = Parcel::STATUS_IN_QUEUE_PROCESSING;
        $this->parcel->save();

        $result = $saasApiCreateParcelService->execute($this->parcelDTO);

        $this->parcel->response_data = json_encode($result);

        $trackingNumber = $result['last_mile_carrier_tracking_number'] ?? '';
        if (!empty($trackingNumber)) {
            $this->parcel->track_number = $trackingNumber;
            $this->parcel->status = Parcel::STATUS_DONE;
        } else {
            $this->parcel->status = Parcel::STATUS_ERROR;
        }

        $this->parcel->save();

        broadcast(new ParcelCreated($this->parcel));
    }
}
