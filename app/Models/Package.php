<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $reference
 * @property string|null $track_number
 * @property string|null $data
 * @property string|null $label
 * @property int $status
 * @property int $contact_id
 * @property string $created_at
 * @property string $updated_at
 * @property Contact $contact
 * @property-read null|PackageGroup $package_group
 */
class Package extends Model
{
    use HasFactory;

    const STATUS_ERROR = 0;
    const STATUS_CANCELED = 50;
    const STATUS_CREATED = 100;
    const STATUS_IN_QUEUE = 200;
    const STATUS_DONE = 1000;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    protected $appends = [
        'can_be_canceled',
        'show_link',
        'cancel_link',
        'downLoad_label_link',
        'status_name',
        'status_color',
        'package_group'
    ];

    public function getShowLinkAttribute() {
        return route('packages.show', ['package' => $this]);
    }

    public function getCancelLinkAttribute() {
        return route('packages.cancel', ['package' => $this]);
    }

    public function getDownLoadLabelLinkAttribute() {
        return route('package.label.download', ['trackNumber' => $this->track_number]);
    }

    public function getStatusNameAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_CANCELED => 'canceled',
            self::STATUS_CREATED => 'created',
            self::STATUS_IN_QUEUE => 'in queue',
            self::STATUS_DONE => 'done',
            default => 'error'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_CREATED => 'primary',
            self::STATUS_IN_QUEUE => 'secondary',
            self::STATUS_DONE => 'success',
            default => 'danger'
        };
    }

    public function getPackageGroupAttribute(): ?PackageGroup
    {
        return $this->packageMainGroup();
    }

    public function getCanBeCanceledAttribute(): bool
    {
        return $this->status !== self::STATUS_CANCELED;
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function packageGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            PackageGroup::class,
            'package_group_map',
            'package_id',
            'package_group_id',
        );
    }

    public function packageMainGroup(): ?PackageGroup
    {
        return $this->packageGroups()->first();
    }
}
