<div class="table bg-white">
    <table class="table table-bordered w-100">
        <thead class="thead-light">
            <tr>
                <th class="text-center text-darker font-weight-bold p-1">Modelo</th>
                <th class="text-center text-darker font-weight-bold p-1">
                    {{ $pastFortnight[0] }} al {{ $pastFortnight[1] }} {{ $pastFortnight[2] }}
                </th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach($pastCammodelsLiquidations as $key => $pastCammodelLiquidation)
            <tr>
                <td class="text-center text-darker p-1">
                    <a href="{{ route('admin.cammodel-stats.show', $pastCammodelLiquidation['cammodel']->id) }}">
                        {{ $pastCammodelLiquidation['cammodel']->employeeName->name }}
                        {{ $pastCammodelLiquidation['cammodel']->employeeName->last_name }}
                        / {{ $pastCammodelLiquidation['cammodel']->nickname }}
                    </a>
                </td>
                <td class="text-darker p-1 text-center"
                    style="
                    @if ($pastCammodelLiquidation['total_usd_cammodel'] < 90)
                        background-color: #FF6961 !important;
                    @elseif ($pastCammodelLiquidation['total_usd_cammodel'] < 250)
                        background-color: #FFAC42 !important;
                    @elseif ($pastCammodelLiquidation['total_usd_cammodel'] < 400)
                        background-color: #FFF379 !important;
                    @elseif ($pastCammodelLiquidation['total_usd_cammodel'] < 600)
                        background-color: #72D035 !important;
                    @else
                        background-color: #66ccff !important;
                    @endif
                    ">
                    ${{ $pastCammodelLiquidation['total_usd_cammodel'] }}
                </td>
            </tr>
            @endforeach
            <tr class="font-weight-bold bg-secondary">
                <td class="text-center text-darker p-1">
                    Total
                </td>
                <td class="text-center text-darker p-1">
                    ${{ $pastLiquidationsTotal }}
                </td>
            </tr>
        </tbody>
    </table>
</div>