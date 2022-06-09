<!-- Eps -->
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Datos de Eps</h3>
                </div>
                <div class="col text-right">
                    <a href="# " data-toggle="modal" data-target="#epsmodal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Eps</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($employee->employeeEpss->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Eps</th>
                                <th class="text-center" scope="col">Fecha Registro</th>
                                <th class="text-center" scope="col">Activo</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($employee->employeeEpss as $employee_eps)
                            <td class="text-center">{{ $employee_eps->eps->eps}}</td>
                            <td class="text-center">{{ $employee_eps->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $employee_eps->status])
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene Eps</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
