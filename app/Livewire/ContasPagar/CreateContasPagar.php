<?php

namespace App\Livewire\ContasPagar;

use App\Models\Caixa;
use App\Models\ContasPagar;
use App\Models\PrevCaixa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateContasPagar extends Component
{
    public $descricao;
    public $id_fornec;
    public $dt_vencimento;
    public $valor;
    public $status = 'A';
    public $plano_pag;
    public $parcela;
    public $dr_parcela_loop;
    public $lan_pag;


    protected $messages = [
        'required' => 'O campo é Obrigatório.',
        'min' => 'Minimo de :min caracteres requerido.',
        'max' => 'Maximo de :max caracteres permitidos.',
    ];

    // Validação em tempo real.
    public function updated()
    {
        if ($this->plano_pag == "U") {
            $this->validate([
                'descricao' => 'required|min:3|max:150',
                'id_fornec' => 'required',
                'dt_vencimento' => 'required',
                'valor' => 'required',
                'plano_pag' => 'required',
            ]);
        } else {
            $this->validate([
                'descricao' => 'required|min:3|max:150',
                'id_fornec' => 'required',
                'dt_vencimento' => 'required',
                'valor' => 'required',
                'parcela' => 'required',
                'plano_pag' => 'required',
            ]);
        }
    }

    public function store()
    {
        if ($this->plano_pag == "U") {
            $this->validate([
                'descricao' => 'required|min:3|max:150',
                'id_fornec' => 'required',
                'dt_vencimento' => 'required',
                'valor' => 'required',
                'plano_pag' => 'required',
            ]);
        } else {
            $this->validate([
                'descricao' => 'required|min:3|max:150',
                'id_fornec' => 'required',
                'dt_vencimento' => 'required',
                'valor' => 'required',
                'parcela' => 'required',
                'plano_pag' => 'required',
            ]);
        }

        // Busca o plano de pagamento selecionado pelo usuario e chama as funções.
        if ($this->plano_pag == "U") {

            $this->Parcela_Unica();
        } elseif ($this->plano_pag == "S") {

            $this->Parcela_Semanal();
        } elseif ($this->plano_pag == "Q") {

            $this->Parcela_Quinzenal();
        } elseif ($this->plano_pag == "M") {

            $this->Parcela_Mensal();
        }
    }

    protected function Parcela_Unica()
    {
        // Busca ultimo lançamento
        $current = ContasPagar::max('num_transent');

        // Pega prox. num de transação.
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $this->parcela = 1;

        // Busca saldo do caixa do usuário.
        $caixa = Caixa::where('id_user', Auth::user()->id)->first();

        if ($this->lan_pag == 1) {

            // verifica se existe saldo para realizar lançamento.

            if ($caixa->saldo < $this->valor) {

                //Se for menor, retorna erro.
                session()->flash('error', 'Saldo insuficiente, operação não realizada!');
                return redirect()->route('create.contaspagar');
            } else {

                // Se existir realiza o processo e desconta no caixa.

                ContasPagar::create([
                    'id_user' => $user_auth,
                    'descricao' => $this->descricao,
                    'id_fornec' => $this->id_fornec,
                    'valor' => $this->valor,
                    'valor_total' => $this->valor,
                    'plano_pag' => $this->plano_pag,
                    'parcela' => $this->parcela,
                    'num_transent' => $num_transent,
                    'dt_vencimento' => $this->dt_vencimento,
                    'status' => 'P',
                ]);

                PrevCaixa::create([
                    'id_user' => $user_auth,
                    'type' => 'CP',
                    'valor' => $this->valor,
                    'parcela' => $this->parcela,
                    'conciliado' => 1,
                    'num_transent' => $num_transent,
                    'dt_vencimento' => $this->dt_vencimento,
                ]);

                //desconta o valor no caixa.
                $caixa->saldo  = ($caixa->saldo - $this->valor);
                $caixa->save();
            }
        } else {
            ContasPagar::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao,
                'id_fornec' => $this->id_fornec,
                'valor' => $this->valor,
                'valor_total' => $this->valor,
                'plano_pag' => $this->plano_pag,
                'parcela' => $this->parcela,
                'num_transent' => $num_transent,
                'dt_vencimento' => $this->dt_vencimento,
                'status' => $this->status,
            ]);

            PrevCaixa::create([
                'id_user' => $user_auth,
                'type' => 'CP',
                'valor' => $this->valor,
                'parcela' => $this->parcela,
                'conciliado' => 0,
                'num_transent' => $num_transent,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contaspagar');
    }

    protected function Parcela_Semanal()
    {
        // Busca ultimo lançamento
        $current = ContasPagar::max('num_transent');

        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $valor_parcela = ($this->valor / $this->parcela);


        for ($i = 1; $i <= $this->parcela; $i++) {

            $days = (7 * ($i - 1));

            $dt_parcela = Carbon::createFromDate($this->dt_vencimento)->addDay($days);

            ContasPagar::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao . " | Prest. ($i)",
                'id_fornec' => $this->id_fornec,
                'valor' => $valor_parcela,
                'valor_total' => $this->valor,
                'plano_pag' => $this->plano_pag,
                'parcela' => $i,
                'num_transent' => $num_transent,
                'dt_vencimento' => $dt_parcela,
                'status' => $this->status,
            ]);

            PrevCaixa::create([
                'id_user' => $user_auth,
                'type' => 'CP',
                'valor' => $valor_parcela,
                'parcela' => $i,
                'conciliado' => 0,
                'num_transent' => $num_transent,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contaspagar');
    }

    protected function Parcela_Quinzenal()
    {
        // Busca ultimo lançamento
        $current = ContasPagar::max('num_transent');
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;


        $valor_parcela = ($this->valor / $this->parcela);

        for ($i = 1; $i <= $this->parcela; $i++) {

            $days = (15 * ($i - 1));

            $dt_parcela = Carbon::createFromDate($this->dt_vencimento)->addDay($days);

            ContasPagar::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao . " | Prest. ($i)",
                'id_fornec' => $this->id_fornec,
                'valor' => $valor_parcela,
                'valor_total' => $this->valor,
                'plano_pag' => $this->plano_pag,
                'parcela' => $i,
                'num_transent' => $num_transent,
                'dt_vencimento' => $dt_parcela,
                'status' => $this->status,
            ]);

            PrevCaixa::create([
                'id_user' => $user_auth,
                'type' => 'CP',
                'valor' => $valor_parcela,
                'parcela' => $i,
                'conciliado' => 0,
                'num_transent' => $num_transent,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contaspagar');
    }

    protected function Parcela_Mensal()
    {
        // Busca ultimo lançamento
        $current = ContasPagar::max('num_transent');
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $valor_parcela = ($this->valor / $this->parcela);


        for ($i = 1; $i <= $this->parcela; $i++) {

            $days = (30 * ($i - 1));

            $dt_parcela = Carbon::createFromDate($this->dt_vencimento)->addDay($days);

            ContasPagar::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao . " | Prest. ($i)",
                'id_fornec' => $this->id_fornec,
                'valor' => $valor_parcela,
                'valor_total' => $this->valor,
                'plano_pag' => $this->plano_pag,
                'parcela' => $i,
                'num_transent' => $num_transent,
                'dt_vencimento' => $dt_parcela,
                'status' => $this->status,
            ]);

            PrevCaixa::create([
                'id_user' => $user_auth,
                'type' => 'CP',
                'valor' => $valor_parcela,
                'parcela' => $i,
                'conciliado' => 0,
                'num_transent' => $num_transent,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contaspagar');
    }


    public function render()
    {
        return view('livewire.contas-pagar.create-contas-pagar');
    }
}
