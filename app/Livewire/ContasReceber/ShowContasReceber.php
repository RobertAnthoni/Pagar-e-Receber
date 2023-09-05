<?php

namespace App\Livewire\ContasReceber;

use App\Models\ContasReceber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowContasReceber extends Component
{
    public $show_conciliado;

    public function ContasReceber()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $contasreceber = ContasReceber::where('id_user', $user_auth)->where('status', '<>', 'R')->orderBy('dt_vencimento')->get();
        return $contasreceber;
    }
    public function AllContasReceber()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $contasreceber = ContasReceber::where('id_user', $user_auth)->orderBy('dt_vencimento')->get();
        return $contasreceber;
    }

    public function render()
    {
        if ($this->show_conciliado == 1) {
            $ContasReceber = $this->AllContasReceber();
        }else{
            $ContasReceber = $this->ContasReceber();
        }

        return view('livewire.contas-receber.show-contas-receber', compact('ContasReceber'));
    }
}
