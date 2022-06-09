<div class="table bg-white">
    <table class="table table-bordered w-100">
        <thead class="thead-light">
            <tr>
                <th class="text-center text-darker font-weight-bold p-1">Modelo</th>
                <th class="text-center text-darker font-weight-bold p-1">
                    {{ $monthsNames['thirdMonthName'] }}
                </th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach($thirdMonthLiquidations as $key => $cammodelLiquidation)
            <tr>
                <td class="text-center text-darker p-1">
                    <a href="{{ route('admin.cammodel-stats.show', $cammodelLiquidation['cammodel']->id) }}">
                        {{ $cammodelLiquidation['cammodel']->employeeName->name }}
                        {{ $cammodelLiquidation['cammodel']->employeeName->last_name }}
                        / {{ $cammodelLiquidation['cammodel']->nickname }}
                    </a>
                </td>
                <td class="text-center text-darker p-1"
                    style="
                    @if ($cammodelLiquidation['total_usd_cammodel'] < 180)
                        background-color: #fa4b4b !important;
                    @elseif ($cammodelLiquidation['total_usd_cammodel'] < 500)
                        background-color: #ffb84d !important;
                    @elseif ($cammodelLiquidation['total_usd_cammodel'] < 800)
                        background-color: #fff34d !important;
                    @elseif ($cammodelLiquidation['total_usd_cammodel'] < 1200)
                        background-color: #62ff4d !important;
                    @else
                        background-color: #66ccff !important;
                    @endif
                    ">
                    ${{ $cammodelLiquidation['total_usd_cammodel'] }}
                </td>
            </tr>
            @endforeach
            <tr class="font-weight-bold bg-secondary">
                <td class="text-left text-darker p-1">
                    Total
                </td>
                <td class="text-center text-darker p-1">
                    ${{ $thirdMonthTotal }}
                </td>
            </tr>
        </tbody>
    </table>
</div>