<?php

namespace App\Events;

use App\Infrastructure\Helpers\FlowStorage;
use App\Models\Parcel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParcelCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $reference;
    public bool $success;
    public string $date;
    public string $message;
    public string $link;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Parcel $parcel)
    {
        $this->reference = $parcel->reference;

        $success = !empty($parcel->track_number);

        $this->success = $success;

        $this->date = $parcel->created_at;

        $message = 'Parcel ' .  $parcel->reference . ' ' . ($success ? ('tracker: ' . $parcel->track_number) : 'error');
        $this->message = $message;

        $this->link = route('parcels.show', ['parcel' => $parcel]);

        FlowStorage::setFlow($parcel->reference, json_encode(get_object_vars($this)));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('flow');
    }
}
