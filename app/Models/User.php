<?php

namespace App\Models;

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'mobile',
        'password',
        'role',
        'cpf_cnpj',
        'user_notes',
        'cep',
        'cidade',
        'rua',
        'bairro',
        'number',
        'company',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'formatted_cpf_cnpj',
        'formatted_cep',
        'formatted_phone',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function rentalItems(): HasMany
    {
        return $this->hasMany(RentalItem::class);
    }

    public function reserves(): HasMany
    {
        return $this->hasMany(Reserve::class);
    }

    public function getFormattedCepAttribute()
    {
        return formatCep($this->cep);
    }

    public function getFormattedCpfCnpjAttribute()
    {
        return formatCpfCnpj($this->cpf_cnpj);
    }

    public function getFormattedPhoneAttribute()
    {
        return formatPhone($this->phone);
    }

    public function uploads(): MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
