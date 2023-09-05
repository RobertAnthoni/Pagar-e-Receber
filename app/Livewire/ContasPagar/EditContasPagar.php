<?php

namespace App\Livewire\ContasPagar;

use App\Models\Caixa;
use App\Models\ContasPagar;
use App\Models\PrevCaixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditContasPagar extends Component
{
    public $id;
    public $descricao;
    public $id_fornec;
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
        $query = ContasPagar::find($request->id);

        if (isset($query->id_user)) {
            if ($query->id_user == $user_auth) {

                $maxparcela = ContasPagar::where('num_transent', $query->num_transent)->max('parcela');
                $this->descricao = $query->descricao;
                $this->id_fornec = $query->id_fornec;
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
                    $this->status = "Pago";
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
        $tituloCP = ContasPagar::where('num_transent', $this->num_transent);
        $tituloCP->delete();
        
        // Busca previsionammento de caixa pelo num_transent
        $prevCaixaCP = PrevCaixa::where('type', 'CP')->where('num_transent', $this->num_transent);
        $prevCaixaCP->delete();

        session()->flash('message', 'Lançamento Excluido!');
        return redirect()->route('index.contaspagar');
    }

    public function update()
    {

        //Busca o titulo a pagar
        $tituloCP = ContasPagar::find($this->id);

        //Busca o lançamento no provisionamento do caixa.
        $prevCaixaCP = PrevCaixa::where('type', 'CP')->where('num_transent', $tituloCP->num_transent)->where('parcela', $tituloCP->parcela)->first();

        //Busca o caixa.
        $caixa = Caixa::where('id_user', Auth::user()->id)->first();

        // verifica se existe saldo para pagar conciliar a pagar.
        if ($caixa->saldo < $prevCaixaCP->valor) {

            //Se for menor, retorna erro.
            session()->flash('error', 'Saldo insuficiente. operação não realizada!');
            return redirect()->route('edit.contaspagar', [$this->id]);
        } else {

            // Torna o estado do titulo como Pago
            $tituloCP->status = 'P';
            $tituloCP->save();

            //desconta o valor no caixa.
            $caixa->saldo  = ($caixa->saldo - $prevCaixaCP->valor);
            $caixa->save();

            // Concilia o lançamento na Prev caixa
            $prevCaixaCP->conciliado = 1;
            $prevCaixaCP->save();

            return redirect()->route('edit.contaspagar', [$this->id]);
        }
    }

    public function render()
    {
        return view('livewire.contas-pagar.edit-contas-pagar');
    }
}
