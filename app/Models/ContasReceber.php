<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasReceber extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'valor',
        'valor_total',
        'id_client',
        'plano_pag',
        'parcela',
        'dt_vencimento',
        'status',
        'num_transent',
        'id_user',
    ];
}
