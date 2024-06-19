<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'price_per_hour',
        'price_per_day',
        'price_per_month',
        'start_time',
        'end_time',
        'status',
        'rental_item_notes',
        'interprise',
        'responsible',
        'cpf_cnpj',
        'mail',
        'phone',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
