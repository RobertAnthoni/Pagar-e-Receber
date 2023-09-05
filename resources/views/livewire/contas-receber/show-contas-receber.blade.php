<x-slot name="header">
    {{ __('Contas a Receber') }}
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="pb-10 flex justify-between">
            <div class="relative flex gap-x-3">
                <div class="flex h-6 items-center">
                    <input wire:model.lazy="show_conciliado" id="show_conciliado" name="show_conciliado" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                </div>
                <div class="text-sm leading-6">
                    <label for="show_conciliado" class="font-medium text-gray-900">Ver Lançamentos Recebidos.</label>
                </div>
            </div>

            <a href="{{ route('create.contasreceber') }}">
                <x-button>
                    Novo Lançamento
                </x-button>
            </a>
        </div>


        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <table class="min-w-full divide-y divide-gray-200 table-fixed">

                {{-- Inicio Cabeçalho Tabela --}}

                <thead class="bg-indigo-500">
                    <tr>
                        <th scope="col"
                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase ">
                            Descrição
                        </th>
                        <th scope="col"
                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase ">
                            Valor
                        </th>
                        <th scope="col"
                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase ">
                            Status
                        </th>
                        <th scope="col"
                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase ">
                            Vencimento
                        </th>
                        <th scope="col" class="p-4">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>

                {{-- Fim Cabeçalho Tabela --}}

                {{-- Inicio Dados Tabela --}}

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ContasReceber as $lan)
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ $lan->descricao }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">R$
                                {{ $lan->valor }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap">
                                @if ($lan->status == 'R')
                                    <p class="text-green-500">Conciliado</p>
                                @else
                                    <p class="text-orange-500">Pendente</p>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap">
                                <?php echo date_format($data = date_create($lan->dt_vencimento), 'd-m-Y'); ?></td>
                            <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                <a href="{{ route('edit.contasreceber', [$lan->id]) }}"
                                    class="text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


                {{-- Fim Dados Tabela --}}


            </table>
            @if (!isset($lan))
                <div class="p-2 flex justify-center">
                    <p>Não foram encontrados registros na base de dados!</p>
                </div>
            @endif

        </div>
    </div>
</div>
