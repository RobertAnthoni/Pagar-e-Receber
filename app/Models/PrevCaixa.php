<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrevCaixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'valor',
        'num_transent',
        'dt_vencimento',
        'parcela',
        'conciliado',
        'id_user',
    ];
    
}
