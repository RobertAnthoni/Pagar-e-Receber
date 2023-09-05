<?php

namespace App\Livewire\ContasReceber;

use App\Models\Caixa;
use App\Models\ContasReceber;
use App\Models\PrevCaixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditContasReceber extends Component
{

    public $id;
    public $descricao;
    public $id_client;
    public $dt_vencimento;
    public $valor;
    public $plano_pag;
    public $parcela;
    public $num_transent;
    public $status;
    public $maxparcela;
    public $valor_total;

    public function mount(Request $request)
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        // Busca informação do lançamento, passado id como parametro.
        $query = ContasReceber::find($request->id);

        if (isset($query->id_user)) {
            if ($query->id_user == $user_auth) {

                $maxparcela = ContasReceber::where('num_transent', $query->num_transent)->max('parcela');
                $this->descricao = $query->descricao;
                $this->id_client = $query->id_client;
                $this->dt_vencimento = $query->dt_vencimento;
                $this->valor = $query->valor;
                $this->plano_pag = $query->plano_pag;
                $this->parcela = $query->parcela;
                $this->num_transent = $query->num_transent;
                $this->valor_total = $query->valor_total;
                $this->maxparcela = $maxparcela;

                if ($query->status == 'A') {
                    $this->status = "Pendente";
                } else {
                    $this->status = "Recebido";
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function delete()
    {
        // Busca titulos a Pagar pelo num_transent
        $tituloCR = ContasReceber::where('num_transent', $this->num_transent);
        $tituloCR->delete();

        // Busca previsionammento de caixa pelo num_transent
        $prevCaixaCR = PrevCaixa::where('type', 'CR')->where('num_transent', $this->num_transent);
        $prevCaixaCR->delete();

        session()->flash('message', 'Lançamento Excluido!');
        return redirect()->route('index.contasreceber');
    }

    public function update()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        //Busca o titulo a receber.
        $tituloCR = ContasReceber::find($this->id);

        //Busca o lançamento no provisionamento do caixa.
        $prevCaixaCR = PrevCaixa::where('type', 'CR')->where('num_transent', $tituloCR->num_transent)->where('parcela', $tituloCR->parcela)->first();

        //Busca o caixa.
        $caixa = Caixa::where('id_user', $user_auth)->first();

        // Torna o titulo como recebido.
        $tituloCR->status = 'R';
        $tituloCR->save();

        // Adiciona o valor no caixa.
        $caixa->saldo  = ($caixa->saldo + $prevCaixaCR->valor);
        $caixa->save();

        // Concilia o lançamento na Prev caixa
        $prevCaixaCR->conciliado = 1;
        $prevCaixaCR->save();

        return redirect()->route('edit.contasreceber', [$this->id]);
    }

    public function render()
    {
        return view('livewire.contas-receber.edit-contas-receber');
    }
}
