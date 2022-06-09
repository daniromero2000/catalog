<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Pre-Liquidación
                  <strong>{{$cammodel_payroll->cammodel->nickname }}</strong><br>
                  Periodo: {{ $cammodel_payroll->from->format('M d, Y') }} - {{ $cammodel_payroll->to->subday(1)->format('M d, Y') }}
                    {{-- <a class="btn btn-primary btn-sm"
                        href="{{route('admin.export.cammodelPayroll', $cammodel_payroll->id)}}" aria-expanded="false"
                        aria-controls="contentId">
                        Exportar Nomina Modelo
                    </a> --}}
            </div>
            @if ($cammodel_payroll->user_approves == null)
            <div class="col text-right">
                <a data-toggle="modal" data-target="#modal{{ $cammodel_payroll->id }}"
                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Aprobar</a>
            </div>
            @endif
        </div>
    </div>
    <div class="w-100">
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">TRM</th>
                        <th scope="col">USD Modelo</th>
                        <th scope="col">Bonificación</th>
                        <th scope="col">Total USD Modelo</th>
                        <th scope="col">Total COP Modelo</th>
                        <th scope="col">Aprobado por</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <td class="text-center">${{ number_format($cammodel_payroll->trm) }}</td>
                        <td class="text-center">${{ number_format($cammodel_payroll->usd_cammodel/2, 2) }}</td>
                        <td class="text-center">${{ number_format($cammodel_payroll->bonus, 2) }}</td>
                        <td class="text-center">${{ number_format($cammodel_payroll->total_usd_cammodel, 2) }}</td>
                        <td class="text-center">${{ number_format($cammodel_payroll->total_cop_cammodel) }}</td>
                        <td class="text-center">{{$cammodel_payroll->user_approves }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
