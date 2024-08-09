<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upload extends Model
{
    protected $fillable = [
        'rental_item_id',
        'user_id',
        'file_name',
        'file_path',
    ];

    public function rentalItem(): BelongsTo
    {
        return $this->belongsTo(RentalItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
