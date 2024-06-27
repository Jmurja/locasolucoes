<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'nome_da_tabela';

    protected $fillable = [
        'id',
        'title',
        'color',
        'start',
        'end',
    ];
}
