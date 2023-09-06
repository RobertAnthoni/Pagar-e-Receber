<x-slot name="header">
    {{ __('Dashboard') }}
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <div class="lg:flex gap-4 items-stretch">

                {{-- Saldo em caixa --}}
                <div class="bg-white md:p-2 p-6 rounded-lg border border-gray-200 mb-4 lg:mb-0 shadow-md lg:w-[35%]">
                    <div class="flex justify-center items-center space-x-5 h-full">
                        <div>
                            <p>Saldo em Caixa</p>
                            <h2 class="text-4xl font-bold text-gray-600">R$ {{ $saldo }}</h2>
                            <p class="text-xs text-red-600">Dívida corrente do mês: R$ {{ $pag_mes }}</p>
                        </div>
                        <img src="https://www.emprenderconactitud.com/img/Wallet.png" alt="wallet"
                            class="h-24 md:h-20 w-38">
                    </div>
                </div>

                {{-- Valores totais em aberto --}}
                <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[65%]">

                    <h2 class="text-gray-500 text-lg font-semibold pb-1">Valores totais em aberto:</h2>
                    <div class="my-1"></div>
                    <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>

                    <div class="flex flex-wrap justify-between h-full">

                        <div
                            class="flex-1 h-max bg-gradient-to-r from-indigo-600 to-indigo-400 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                            <i class="fas fa-hand-holding-usd text-white text-4xl"></i>
                            <p class="text-white">A Pagar</p>
                            <p class="text-white">R$ {{ $pagar_aberto }}</p>
                        </div>

                        <div
                            class="flex-1 h-max bg-gradient-to-r from-indigo-400 to-indigo-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                            <i class="fas fa-exchange-alt text-white text-4xl"></i>
                            <p class="text-white">A Receber</p>
                            <p class="text-white">R$ {{ $receber_aberto }}</p>
                        </div>

                        @if ($receber_aberto + $saldo - $pagar_aberto >= 0)
                            <div
                                class="flex-1 h-max bg-gradient-to-r from-green-400 to-green-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                            @else
                                <div
                                    class="flex-1 h-max bg-gradient-to-r from-red-400 to-red-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                        @endif
                        <i class="fas fa-exchange-alt text-white text-4xl"></i>
                        <p class="text-white">Balanço </p>
                        <p class="text-white">R$ <?php echo $balanco = number_format($balanco, 2, ',', ' '); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">

            <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                <h2 class="text-gray-500 text-lg font-semibold pb-1">Pagamentos Próximos / Vencidos</h2>
                <div class="my-1"></div>
                <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>
                <div class="chart-container p-3 overflow-auto" style="position: relative; height:150px; width:100%">
                    {{-- <canvas id="myChart"></canvas> --}}

                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal">
                                <th
                                    class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                                    Descrição</th>
                                <th
                                    class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                                    vencimento</th>
                                <th
                                    class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">
                                    Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pag_prox as $lan)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-2 px-4 border-b border-grey-light">{{ $lan->descricao }}</td>
                                    <td class="py-2 px-4 text-center border-b border-grey-light">
                                        <?php echo date_format($data = date_create($lan->dt_vencimento), 'd-m-Y'); ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-grey-light text-right">R$
                                        {{ $lan->valor }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- grafico de Provisionamento de caixa --}}
            <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                <h2 class="text-gray-500 text-lg font-semibold pb-1">Provisionamento Mensal</h2>
                <div class="my-1"></div>
                <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>
                <div class="chart-container" style="position: relative; height:150px; width:100%">
                    <canvas id="graficoprev"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var graficoprev = new Chart(document.getElementById('graficoprev'), {
        type: 'doughnut',
        data: {
            labels: ['A Pagar', 'A Receber'],
            datasets: [{
                data: [{{ $prevpagar }}, {{ $prevreceber }}],
                backgroundColor: ['#e03030', '#767cf4'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom' // Ubicar la leyenda debajo del círculo
            }
        }
    });
</script>
