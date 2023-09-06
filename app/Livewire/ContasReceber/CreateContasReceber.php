<?php

namespace App\Livewire\ContasReceber;

use App\Models\Caixa;
use App\Models\ContasReceber;
use App\Models\PrevCaixa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateContasReceber extends Component
{

    public $descricao;
    public $id_client;
    public $dt_vencimento;
    public $valor;
    public $plano_pag;
    public $parcela;
    public $dr_parcela_loop;
    public $status = 'A';
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
                'id_client' => 'required',
                'dt_vencimento' => 'required',
                'valor' => 'required',
                'plano_pag' => 'required',
            ]);
        } else {
            $this->validate([
                'descricao' => 'required|min:3|max:150',
                'id_client' => 'required',
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
                'id_client' => 'required',
                'dt_vencimento' => 'required',
                'valor' => 'required',
                'plano_pag' => 'required',
            ]);
        } else {
            $this->validate([
                'descricao' => 'required|min:3|max:150',
                'id_client' => 'required',
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
        $current = ContasReceber::max('num_transent');
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $this->parcela = 1;

        if ($this->lan_pag == 1) {

            ContasReceber::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao,
                'id_client' => $this->id_client,
                'valor' => $this->valor,
                'valor_total' => $this->valor,
                'plano_pag' => $this->plano_pag,
                'parcela' => $this->parcela,
                'num_transent' => $num_transent,
                'dt_vencimento' => $this->dt_vencimento,
                'status' => 'R',
            ]);

            PrevCaixa::create([
                'id_user' => $user_auth,
                'type' => 'CR',
                'valor' => $this->valor,
                'parcela' => $this->parcela,
                'num_transent' => $num_transent,
                'conciliado' => 1,
                'dt_vencimento' => $this->dt_vencimento,
            ]);

            $caixa = Caixa::where('id_user', $user_auth)->first();

            $caixa->saldo  = ($caixa->saldo + $this->valor);
            $caixa->save();
        } else {
            ContasReceber::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao,
                'id_client' => $this->id_client,
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
                'type' => 'CR',
                'valor' => $this->valor,
                'parcela' => $this->parcela,
                'num_transent' => $num_transent,
                'conciliado' => 0,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }


        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contasreceber');
    }

    protected function Parcela_Semanal()
    {
        // Busca ultimo lançamento
        $current = ContasReceber::max('num_transent');
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $valor_parcela = ($this->valor / $this->parcela);


        for ($i = 1; $i <= $this->parcela; $i++) {

            $days = (7 * ($i - 1));

            $dt_parcela = Carbon::createFromDate($this->dt_vencimento)->addDay($days);

            ContasReceber::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao . " | Prest. ($i)",
                'id_client' => $this->id_client,
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
                'type' => 'CR',
                'valor' => $valor_parcela,
                'parcela' => $i,
                'num_transent' => $num_transent,
                'conciliado' => 0,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contasreceber');
    }

    protected function Parcela_Quinzenal()
    {
        // Busca ultimo lançamento
        $current = ContasReceber::max('num_transent');
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        $valor_parcela = ($this->valor / $this->parcela);


        for ($i = 1; $i <= $this->parcela; $i++) {

            $days = (15 * ($i - 1));

            $dt_parcela = Carbon::createFromDate($this->dt_vencimento)->addDay($days);

            ContasReceber::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao . " | Prest. ($i)",
                'id_client' => $this->id_client,
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
                'type' => 'CR',
                'valor' => $valor_parcela,
                'parcela' => $i,
                'num_transent' => $num_transent,
                'conciliado' => 0,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contasreceber');
    }

    protected function Parcela_Mensal()
    {
        // Busca ultimo lançamento
        $current = ContasReceber::max('num_transent');
        $num_transent = ($current + 1);

        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;


        $valor_parcela = ($this->valor / $this->parcela);


        for ($i = 1; $i <= $this->parcela; $i++) {

            $days = (30 * ($i - 1));

            $dt_parcela = Carbon::createFromDate($this->dt_vencimento)->addDay($days);

            ContasReceber::create([
                'id_user' => $user_auth,
                'descricao' => $this->descricao . " | Prest. ($i)",
                'id_client' => $this->id_client,
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
                'type' => 'CR',
                'valor' => $valor_parcela,
                'parcela' => $i,
                'num_transent' => $num_transent,
                'conciliado' => 0,
                'dt_vencimento' => $this->dt_vencimento,
            ]);
        }

        session()->flash('message', 'Adicionado com Sucesso!');
        return redirect()->route('index.contasreceber');
    }

    public function render()
    {
        return view('livewire.contas-receber.create-contas-receber');
    }
}
