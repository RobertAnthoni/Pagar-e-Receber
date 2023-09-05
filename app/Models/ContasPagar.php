<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasPagar extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'valor',
        'valor_total',
        'id_fornec',
        'plano_pag',
        'parcela',
        'dt_vencimento',
        'status',
        'num_transent',
        'id_user',
    ];
}
