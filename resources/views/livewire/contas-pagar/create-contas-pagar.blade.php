<x-slot name="header">
    {{ __('Lançar a Pagar') }}
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <div class="w-full flex justify-center bg-indigo-500 p-2 text-lg font-bold text-white rounded">Lançamento de
                contas a pagar</div>


            <form wire:submit.prevent="store" method="POST">

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">


                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                            <div class="md:col-span-5">
                                <label for="descricao">Descrição</label>
                                <input wire:model.lazy="descricao" type="text" name="descricao" id="descricao"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                @error('descricao')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-3">
                                <label for="id_fornec">Fornecedor</label>
                                <div
                                    class="h-10 bg-gray-50 flex border gap-3 border-gray-200 rounded items-center mt-1">
                                    <select wire:model.lazy="id_fornec" name="id_fornec" id="id_fornec"
                                        class="rounded px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                                        <option value="null" selected disabled>Selecione uma opção</option>
                                        <option value="1">João - Empresa X</option>
                                        <option value="2">Maria - Empresa Y</option>
                                        <option value="3">Pedro - Empresa Z</option>
                                    </select>

                                </div>
                                @error('id_fornec')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="dt_vencimento">Data de Vencimento</label>
                                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <input wire:model.lazy="dt_vencimento" type="date" name="dt_vencimento"
                                        id="dt_vencimento"
                                        class="rounded px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" />
                                </div>
                                @error('dt_vencimento')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="md:col-span-2">
                                <label for="valor">Valor</label>
                                <input wire:model.lazy="valor" min="1" type="number" step="0.01"
                                    name="valor" id="valor"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="R$ 000.00" />
                                @error('valor')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="plano_pag">Plano de Pagamento</label>
                                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <select wire:model.lazy="plano_pag" name="plano_pag" id="plano_pag"
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

                            @if ($this->plano_pag != 'U')
                                <div class="md:col-span-1">
                                    <label for="parcela">Parcelas</label>
                                    <input wire:model.lazy="parcela" min="2" type="number" name="parcela"
                                        id="parcela"
                                        class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                    @error('parcela')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="md:col-span-5 text-right pt-3">
                                @if ($this->plano_pag == 'U')
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model="lan_pag" id="lan_pag" name="lan_pag"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="lan_pag" class="font-medium text-gray-900">Lançar como
                                                Pago.</label>
                                        </div>
                                    </div>
                                @endif

                                <x-button>Salvar</x-button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
