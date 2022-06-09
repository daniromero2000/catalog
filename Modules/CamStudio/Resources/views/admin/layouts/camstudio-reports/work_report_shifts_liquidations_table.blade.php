<div class="col-lg-12 col-xl-12 px-0 mb-2">
    <div class="table bg-white">
        <table class="table table-bordered w-100">
            <thead class="thead-light">
                <tr>
                    <th class="text-center text-darker font-weight-bold p-1">
                        Total Aporte Por Turno Reportado
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
                @foreach($workReportShiftMonthsTotal as $key => $workReportShiftLiquidation)
                <tr>
                    <td class="text-left text-darker p-1">
                        {{ $workReportShiftLiquidation['shift_name'] }}
                    </td>
                    <td class="text-center text-darker p-1">
                        ${{ $workReportShiftLiquidation['prev_period_dollars'] }}
                    </td>
                    <td class="text-center text-darker p-1">
                        ${{ $workReportShiftLiquidation['actual_period_dollars'] }}
                    </td>
                    <td class="text-center text-darker font-weight-bold p-1"
                        style="
                        @if ($workReportShiftLiquidation['change_rate'] < 0)
                            color: #fa4b4b !important;
                        @elseif ($workReportShiftLiquidation['change_rate'] == 0)
                            color: #000000 !important;
                        @elseif ($workReportShiftLiquidation['change_rate'] < 15)
                            color: #FFC102 !important;
                        @elseif ($workReportShiftLiquidation['change_rate'] > 15)
                            color: #72D035 !important;
                        @else
                            color: #66ccff !important;
                        @endif
                        ">
                        {{ $workReportShiftLiquidation['change_rate'] }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>