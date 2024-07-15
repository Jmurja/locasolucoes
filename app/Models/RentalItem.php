<?php

namespace App\Models;

use App\Enum\RentalItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
