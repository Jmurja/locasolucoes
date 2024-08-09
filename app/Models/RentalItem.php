<?php

namespace App\Models;

use App\Enum\RentalItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price_per_hour',
        'price_per_day',
        'price_per_month',
        'status',
        'rental_item_notes',
    ];

    protected $appends = [
        'price_per_hour_formatted',
        'price_per_day_formatted',
        'price_per_month_formatted',
    ];

    protected function casts(): array
    {
        return [
            'status' => RentalItemStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function reserves(): BelongsTo
    {
        return $this->belongsTo(Reserve::class);
    }

    public function uploads(): morphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    public function getPricePerHourFormattedAttribute(): string
    {
        return number_format($this->price_per_hour, 2);
    }

    public function getPricePerDayFormattedAttribute(): string
    {
        return number_format($this->price_per_day, 2);
    }

    public function getPricePerMonthFormattedAttribute(): string
    {
        return number_format($this->price_per_month, 2);
    }
}
