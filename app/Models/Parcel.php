<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $reference
 * @property string|null $track_number
 * @property string|null $request_data
 * @property string|null $response_data
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Parcel extends Model
{
    use HasFactory;

    const STATUS_ERROR = 0;
    const STATUS_CREATED = 100;
    const STATUS_IN_QUEUE = 200;
    const STATUS_IN_QUEUE_PROCESSING = 220;
    const STATUS_DONE = 1000;

    protected $fillable = ['reference', 'track_number', 'request_data', 'response_data', 'status'];

    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
    ];

    public function getStatusName(): string
    {
        return match ($this->status) {
            self::STATUS_CREATED => 'created',
            self::STATUS_IN_QUEUE => 'in queue',
            self::STATUS_IN_QUEUE_PROCESSING => 'in queue processing',
            self::STATUS_DONE => 'done',
            default => 'error'
        };
    }

    public function getStatusColor(): string
    {
        return match ($this->status) {
            self::STATUS_CREATED => 'primary',
            self::STATUS_IN_QUEUE, self::STATUS_IN_QUEUE_PROCESSING => 'secondary',
            self::STATUS_DONE => 'success',
            default => 'danger'
        };
    }
}
