<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"><strong>Ingresos de Modelos a liquidar </strong>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if(!$uncutCammodelStreamingIncomes->isEmpty())
                <table id="incomes-table"
                    class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th onclick="sortTable(0)" scope="col">Cuenta Modelo</th>
                            <th scope="col">Total Tokens</th>
                            <th scope="col">Total USD</th>
                            <th scope="col">Aprobado</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($uncutCammodelStreamingIncomes as $data)
                        <tr>
                            <td class="text-center">
                                {{$data->cammodelStreamAccount->cammodel->nickname }} /
                                {{$data->cammodelStreamAccount->streaming->streaming}}
                            </td>
                            <td class="text-center">{{ number_format($data->accumulated_tokens, 2) }}</td>
                            <td class="text-center">{{ number_format(($data->accumulated_dollars/2), 2) }}</td>
                            <td class="text-center">
                                {{$data->user_approves }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm">No tiene Ingresos de Modelos <strong>APROBADOS</strong> para
                    liquidar</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
