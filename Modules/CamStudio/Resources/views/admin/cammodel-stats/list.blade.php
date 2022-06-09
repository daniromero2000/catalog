@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if (!empty($cammodelStreamingIncomes))
    <div class="card">
        <div class="card-header border-0">
            <div class="row">
                <div class="col-12 text-left">
                    <span class="h3 mb-0 px-4"> Progreso de Ventas </span>
                    <span>{{ 'desde: '.$liquidation_period['0'].', hasta: '.$liquidation_period['1'] }} </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="stats-table" class="table table-striped align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th onclick="sortTable(0)" class="text-center">{{ $headers[0] }}</th>
                        <th onclick="sortTable(1)" class="text-center">{{ $headers[1] }}</th>
                        <th class="text-center">{{ $headers[2] }}</th>
                        <th class="text-center">{{ $headers[3] }}</th>
                    </tr>
                </thead>
                <tbody class="list text-center">
                    @foreach($cammodelStreamingIncomes as $cammodelStreamingIncome)
                    <tr>
                        <td>{{ $cammodelStreamingIncome['cammodel']['nickname'] }}</td>
                        <td>{{ $cammodelStreamingIncome['usd_cammodel'] / 2 }}</td>
                        <td class="text-center">
                            <div class="progress w-100">
                                <div class="progress-bar" role="progressbar"
                                    aria-valuenow="{{ $cammodelStreamingIncome['usd_cammodel'] / 2 }}" aria-valuemin="0"
                                    aria-valuemax="{{ $cammodelStreamingIncome['cammodel']['shift']['goal']['usd_goal'] }}"
                                    style="width: {{ (100 / $cammodelStreamingIncome['cammodel']['shift']['goal']['usd_goal']) 
                                    * ($cammodelStreamingIncome['usd_cammodel'] / 2) }}%;
                                @if ($cammodelStreamingIncome['total_usd_cammodel'] < 90)
                                    background-color: #fa4b4b !important;
                                @elseif ($cammodelStreamingIncome['total_usd_cammodel'] < 220)
                                    background-color: #ffb84d !important;
                                @elseif ($cammodelStreamingIncome['total_usd_cammodel'] < 
                                    $cammodelStreamingIncome['cammodel']['shift']['goal']['usd_goal'])
                                    background-color: #fff34d !important;
                                @else
                                    background-color: #62ff4d !important;
                                @endif
                                "></div>
                            </div>
                            <span>{{ number_format((100 / 
                                $cammodelStreamingIncome['cammodel']['shift']['goal']['usd_goal']) * 
                                ($cammodelStreamingIncome['usd_cammodel'] / 2), 1) }}%</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.cammodel-stats.show', $cammodelStreamingIncome['cammodel_id']) }}">
                                <span><i class="fas fa-search"></i></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
<script>
    function sortTable(column = 0) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("stats-table");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[column];
                y = rows[i + 1].getElementsByTagName("TD")[column];
                if (column == 0) {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else{
                    if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

</script>
@endsection
