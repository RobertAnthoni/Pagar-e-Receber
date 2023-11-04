<x-form-section submit="">
    <x-slot name="title">
        {{ __('Caixas') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Seus caixas serão expostos aqui.') }}
    </x-slot>


    <x-slot name="form">

        @foreach ($All_caixas as $caixas)
            <div class="col-span-6 sm:col-span-4">
                {{ $caixas->descricao }} - {{ 'R$ ' . $caixas->saldo }}
            </div>
        @endforeach

    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ __('Criar Novo') }}
        </x-button>
    </x-slot>
</x-form-section>
