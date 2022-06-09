<div class="table bg-white">
    <table class="table table-bordered w-100">
        <thead class="thead-light">
            <tr>
                <th class="text-center text-darker font-weight-bold p-1">Modelo</th>
                <th class="text-center text-darker font-weight-bold p-1">
                    {{ $actualFortnight[0] }} al {{ $actualFortnight[1] }} {{ $actualFortnight[2] }}
                </th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach($actualCammodelsLiquidations as $key => $cammodelLiquidation)
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
                    @if ($cammodelLiquidation['total_usd_cammodel'] < 90)
                        background-color: #FB675F !important;
                    @elseif ($cammodelLiquidation['total_usd_cammodel'] < 250)
                        background-color: #FFAC42 !important;
                    @elseif ($cammodelLiquidation['total_usd_cammodel'] < 400)
                        background-color: #FFF379 !important;
                    @elseif ($cammodelLiquidation['total_usd_cammodel'] < 600)
                        background-color: #72D035 !important;
                    @else
                        background-color: #66ccff !important;
                    @endif
                    ">
                    ${{ $cammodelLiquidation['total_usd_cammodel'] }}
                </td>
            </tr>
            @endforeach
            <tr class="font-weight-bold bg-secondary">
                <td class="text-center text-darker p-1">
                    Total
                </td>
                <td class="text-center text-darker p-1">
                    ${{ $actualLiquidationsTotal }}
                </td>
            </tr>
        </tbody>
    </table>
</div>