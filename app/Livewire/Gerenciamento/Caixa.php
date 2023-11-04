<?php

namespace App\Livewire\Gerenciamento;

use App\Models\Caixa as ModelsCaixa;
use Livewire\Component;

class Caixa extends Component
{
    public function ShowCaixas ()
    {
        $All_caixas = ModelsCaixa::all();
        return $All_caixas;
    }

    public function render()
    {
        $All_caixas = $this->ShowCaixas();
        return view('livewire.gerenciamento.caixa', compact('All_caixas'));
    }
}
