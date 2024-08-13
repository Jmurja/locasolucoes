<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'rental_item_id',
        'reserve_notes',
        'title',
        'description',
        'reserve_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function rentalItem(): BelongsTo
    {
        return $this->belongsTo(RentalItem::class)->withTrashed();
    }
}
