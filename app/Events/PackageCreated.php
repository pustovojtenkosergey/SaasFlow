<?php

namespace App\Events;

use App\Infrastructure\Helpers\FlowStorage;
use App\Models\Package;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PackageCreated implements ShouldBroadcast
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
    public function __construct(Package $package)
    {
        $this->reference = $package->reference;

        $success = !empty($package->track_number);

        $this->success = $success;

        $this->date = $package->created_at;

        $message = 'Package ' .  $package->reference . ' ' . ($success ? ('tracker: ' . $package->track_number) : 'error');
        $this->message = $message;

        $this->link = route('packages.show', ['package' => $package]);

        FlowStorage::setFlow($package->reference, json_encode(get_object_vars($this)));
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
