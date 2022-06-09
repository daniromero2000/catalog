<div class="col-lg-12 col-xl-12">
    <div class="row">
        <div class="col-12 text-center bg-blue text-white font-weight-bold overflow-hidden">
            COMPARACIÓN DE VENTAS DE {{ Str::upper($actualFortnight[3]) }} Y 
                {{ Str::upper($actualFortnight[2]) }} - POR MODELO (USD)
        </div>
        <div class="col-12 px-0">
            <div class="table bg-white">
                <table class="table table-bordered w-100">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center text-darker font-weight-bold p-1">Colores Crecimientos</th>
                            <th class="text-center font-weight-bold text-darker p-1" style="color: #72D035 !important;">
                                Superior al 15%
                            </th>
                            <th class="text-center font-weight-bold text-darker p-1" style="color: #FFC102 !important;">
                                Entre el 1% y el 14%
                            </th>
                            <th class="text-center font-weight-bold text-darker p-1" style="color: #fa4b4b !important;">
                                Decrecimiento
                            </th>
                            <th class="text-center font-weight-bold text-darker p-1">
                                Crítica - antes de ajuste
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-12 px-0 mb-2">
            <div class="table bg-white">
                <table class="table table-bordered w-100">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center text-darker font-weight-bold p-1">Modelo</th>
                            <th class="text-center text-darker font-weight-bold p-1">
                                Total Aporte {{ $actualFortnight[3] }}
                            </th>
                            <th class="text-center text-darker font-weight-bold p-1">
                                Total Aporte {{ $actualFortnight[2] }}
                            </th>
                            <th class="text-center text-darker font-weight-bold p-1">Crecimientos</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($compoundCammodelsLiquidations as $key => $compoundLiquidation)
                        <tr>
                            <td class="text-left text-darker p-1">
                                <a href="{{ route('admin.cammodel-stats.show', $compoundLiquidation['cammodel']->id) }}">
                                    {{ $compoundLiquidation['cammodel']->employeeName->name }}
                                    {{ $compoundLiquidation['cammodel']->employeeName->last_name }}
                                    / {{ $compoundLiquidation['cammodel']->nickname }}
                                </a>
                            </td>
                            <td class="text-center text-darker p-1">
                                ${{ $compoundLiquidation['past_month_usd'] }}
                            </td>
                            <td class="text-center text-darker p-1" style="
                                @if ($compoundLiquidation['actual_month_usd'] < 180)
                                    background-color: #FB675F !important;
                                @elseif ($compoundLiquidation['actual_month_usd'] < 500)
                                    background-color: #FFAC42 !important;
                                @elseif ($compoundLiquidation['actual_month_usd'] < 800)
                                    background-color: #FFF379 !important;
                                @elseif ($compoundLiquidation['actual_month_usd'] < 1200)
                                    background-color: #72D035 !important;
                                @else
                                    background-color: #66CCFF !important;
                                @endif
                                ">
                                ${{ $compoundLiquidation['actual_month_usd'] }}
                            </td>
                            <td class="text-center text-darker font-weight-bold p-1" style="
                                @if ($compoundLiquidation['change_rate'] < 0)
                                    color: #fa4b4b !important;
                                @elseif ($compoundLiquidation['change_rate'] == 0)
                                    color: #000000 !important;
                                @elseif ($compoundLiquidation['change_rate'] < 15)
                                    color: #FFC102 !important;
                                @elseif ($compoundLiquidation['change_rate'] > 15)
                                    color: #72D035 !important;
                                @else
                                    color: #66ccff !important;
                                @endif
                                ">
                                {{ $compoundLiquidation['change_rate'] }}%
                            </td>
                        </tr>
                        @endforeach
                        <tr class="font-weight-bold bg-secondary">
                            <td class="text-left text-darker p-1">Total x Mes</td>
                            <td class="text-center text-darker p-1">
                                ${{$monthsTotalUsd['first_month_total']}}</td>
                            <td class="text-center text-darker p-1">
                                ${{$monthsTotalUsd['second_month_total']}}</td>
                            <td class="text-center text-darker p-1" style="
                                @if ($compoundLiquidation['change_rate'] < 0)
                                    color: #fa4b4b !important;
                                @elseif ($compoundLiquidation['change_rate'] == 0)
                                    color: #000000 !important;
                                @elseif ($compoundLiquidation['change_rate'] < 15)
                                    color: #FFC102 !important;
                                @elseif ($compoundLiquidation['change_rate'] > 15)
                                    color: #72D035 !important;
                                @else
                                    color: #66ccff !important;
                                @endif
                                ">{{$monthsTotalUsd['change_rate']}}%
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
