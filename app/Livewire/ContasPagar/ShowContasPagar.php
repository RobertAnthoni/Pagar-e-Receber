<?php

namespace App\Livewire\ContasPagar;

use App\Models\ContasPagar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowContasPagar extends Component
{
    public $show_conciliado;

    public function ContasPagar()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        // Busca contas a pagar do usuario, ordenado por vencimento.
        $contaspagar = ContasPagar::where('id_user', $user_auth)->where('status', '<>', 'P')->orderBy('dt_vencimento')->get();
        return $contaspagar;
    }

    public function AllContasPagar()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        // Busca contas a pagar do usuario, ordenado por vencimento.
        $contaspagar = ContasPagar::where('id_user', $user_auth)->orderBy('dt_vencimento')->get();
        return $contaspagar;
    }


    public function render()
    {
        if($this->show_conciliado == 1){
            $ContasPagar = $this->AllContasPagar();
        }else{
            $ContasPagar = $this->ContasPagar();
        }

        return view('livewire.contas-pagar.show-contas-pagar', compact('ContasPagar'));
    }
}
