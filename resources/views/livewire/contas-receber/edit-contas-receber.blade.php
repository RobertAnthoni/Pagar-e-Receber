<x-slot name="header">
    {{ __('Ver Titulos a Receber') }}
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <div class="w-full flex justify-center bg-indigo-500 p-2 text-lg font-bold text-white rounded">Ver titulo a
                Receber</div>

            <form wire:submit.prevent="update" method="POST">

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                            <div class="md:col-span-5">
                                <label for="descricao">Descrição</label>
                                <input disabled wire:model.lazy="descricao" type="text" name="descricao"
                                    id="descricao" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                @error('descricao')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-3">
                                <label for="id_client">Fornecedor</label>
                                <div
                                    class="h-10 bg-gray-50 flex border gap-3 border-gray-200 rounded items-center mt-1">
                                    <select disabled wire:model.lazy="id_client" name="id_client" id="id_client"
                                        class="rounded px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                                        <option value="null" selected disabled>Selecione uma opção</option>
                                        <option value="1">Pendente</option>
                                        <option value="2">Pago</option>
                                    </select>
                                </div>
                                @error('id_fornec')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="dt_vencimento">Data de Vencimento</label>
                                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <input disabled wire:model.lazy="dt_vencimento" type="date" name="dt_vencimento"
                                        id="dt_vencimento"
                                        class="rounded px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" />
                                </div>
                                @error('dt_vencimento')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="md:col-span-2">
                                <label for="valor">Valor</label>
                                <input disabled wire:model.lazy="valor" min="1" type="number" step="0.01"
                                    name="valor" id="valor"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="R$ 000.00" />
                                @error('valor')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="plano_pag">Plano de Pagamento</label>
                                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <select disabled wire:model.lazy="plano_pag" name="plano_pag" id="plano_pag"
                                        class="rounded px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                                        <option value="null" selected disabled>Selecione uma opção</option>
                                        <option value="U">Unica</option>
                                        <option value="S">Semanal</option>
                                        <option value="Q">Quinzenal</option>
                                        <option value="M">Mensal</option>
                                    </select>
                                </div>
                                @error('plano_pag')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-1">
                                <label for="parcela">Prestação</label>
                                <input disabled wire:model.lazy="parcela" min="0" type="number" name="parcela"
                                    id="parcela"
                                    class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                @error('parcela')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-1 mt-2">
                                <h1><b>Informações:</b></h1>

                                <p>Nº de transação: {{ $num_transent }}</p>
                                <p>Valor do lançamento: R${{ $valor_total }}</p>
                                <p>Prestação: {{ $parcela }} de {{ $maxparcela }}</p>
                                <p>Status: {{ $status }}</p>
                            </div>

                            @if ($status != 'Recebido')
                                <div class="md:col-span-5 text-right pt-3">
                                    <x-danger-button class="mx-3 my-2" wire:click="delete">Excluir Lançamento
                                        Completo</x-danger-button>
                                    <x-button class="mx-3 my-2">Conferir Recebimento</x-button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
