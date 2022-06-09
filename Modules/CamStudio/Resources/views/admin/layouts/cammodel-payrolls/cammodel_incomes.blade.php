<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col justify-content-right d-flex">
                <h3 class="mb-0"><strong>Ingresos de Modelo en Periodo</strong>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($cammodel_payroll->cammodelStreamingIncomes)
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Streaming</th>
                            <th scope="col">Tokens</th>
                            <th scope="col">Dollars</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($cammodel_payroll->cammodelStreamingIncomes as $data)
                        <tr>
                            <td class="text-center">{{$data->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center">
                                {{$data->cammodelStreamAccount->profile}}
                                {{$data->cammodelStreamAccount->streaming->streaming }}
                            </td>
                            <td class="text-center">{{ number_format($data->tokens, 0) }}</td>
                            <td class="text-center">${{ number_format($data->dollars, 2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm">No tiene Pagos</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
