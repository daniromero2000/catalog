<div class="col-lg-12 col-xl-12 px-0 mb-2">
    <div class="col-12 text-center bg-blue text-white font-weight-bold overflow-hidden">
        COMPARACIÓN DE VENTAS DE {{ Str::upper($actualFortnight[3]) }} Y 
            {{ Str::upper($actualFortnight[2]) }} - POR TURNOS (USD)
    </div>
    <div class="table bg-white">
        <table class="table table-bordered w-100">
            <thead class="thead-light">
                <tr>
                    <th class="text-center text-darker font-weight-bold p-1">
                        Total Aporte Por Turno Asignado a Modelos
                    </th>
                    <th class="text-center font-weight-bold text-darker p-1">
                        {{ $actualFortnight[3] }}
                    </th>
                    <th class="text-center font-weight-bold text-darker p-1">
                        {{ $actualFortnight[2] }}
                    </th>
                    <th class="text-center font-weight-bold text-darker p-1">
                        Crecimiento
                    </th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach($cammodelShiftMonthsTotal as $key => $cammodelShiftLiquidation)
                <tr>
                    <td class="text-left text-darker p-1">
                        {{ $cammodelShiftLiquidation['shift_name'] }}
                    </td>
                    <td class="text-center text-darker p-1">
                        ${{ $cammodelShiftLiquidation['first_month_usd'] }}
                    </td>
                    <td class="text-center text-darker p-1">
                        ${{ $cammodelShiftLiquidation['second_month_usd'] }}
                    </td>
                    <td class="text-center text-darker font-weight-bold p-1"
                        style="
                        @if ($cammodelShiftLiquidation['change_rate'] < 0)
                            color: #fa4b4b !important;
                        @elseif ($cammodelShiftLiquidation['change_rate'] == 0)
                            color: #000000 !important;
                        @elseif ($cammodelShiftLiquidation['change_rate'] < 15)
                            color: #FFC102 !important;
                        @elseif ($cammodelShiftLiquidation['change_rate'] > 15)
                            color: #72D035 !important;
                        @else
                            color: #66ccff !important;
                        @endif
                        ">
                        {{ $cammodelShiftLiquidation['change_rate'] }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>