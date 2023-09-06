<?php

namespace App\Livewire\Dashboard;

use App\Models\Caixa;
use App\Models\ContasPagar;
use App\Models\ContasReceber;
use App\Models\PrevCaixa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $saldo;
    public $pagar_aberto;
    public $receber_aberto;
    public $now;
    public $balanco;

    public function mount()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        //Busca caixa
        $caixa = Caixa::where('id_user', $user_auth)->first();
        $this->saldo = $caixa->saldo;

        //Valores a pagar em aberto.
        $pagar_aberto = ContasPagar::where('status', 'A')->where('id_user', $user_auth)->sum('valor');
        $this->pagar_aberto = $pagar_aberto;

        //Valores a receber em aberto.
        $receber_aberto = ContasReceber::where('status', 'A')->where('id_user', $user_auth)->sum('valor');
        $this->receber_aberto = $receber_aberto;

        $this->balanco = (($receber_aberto + $this->saldo) - $pagar_aberto);
    }

    public function render()
    {
        //Busca o usuario autenticado.
        $user_auth = Auth::user()->id;

        //Busca o mes corrente.
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $this->now = Carbon::now();

        // Busca pagamentos proximos
        $pag_prox = ContasPagar::whereMonth('dt_vencimento', $currentMonth)
            ->whereYear('dt_vencimento', $currentYear)
            ->where('status', 'A')->where('id_user', $user_auth)->orderBy('dt_vencimento')->limit(10)
            ->orWhere('dt_vencimento', '<', $this->now)
            ->get();

        // Monta o grafico de previsão de caixa.
        $prevpagar = PrevCaixa::whereMonth('dt_vencimento', $currentMonth)
            ->whereYear('dt_vencimento', $currentYear)
            ->where('type', 'CP')
            ->where('id_user', $user_auth)
            ->sum('valor');

        $prevreceber = PrevCaixa::whereMonth('dt_vencimento', $currentMonth)
            ->whereYear('dt_vencimento', $currentYear)
            ->where('type', 'CR')
            ->where('id_user', $user_auth)
            ->sum('valor');

        return view('livewire.dashboard.dashboard', compact('prevpagar', 'prevreceber', 'pag_prox'));
    }
}
