<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col justify-content-right d-flex">
                <h3 class="mb-0"><strong>Faltas de Modelo en Periodo</strong>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if(!$cammodel_payroll->cammodelFines->isEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Falta</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($cammodel_payroll->cammodelFines as $data)
                        <tr>
                            <td class="text-center">{{$data->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center">{{$data->foul->name}}</td>
                            <td class="text-center">${{number_format($data->foul->charge)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm">No tiene faltas en el periodo</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
