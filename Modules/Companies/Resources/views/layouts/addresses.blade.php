<!-- Residences -->
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Residencia</h3>
                </div>
                <div class="col text-right">
                    <a href="# " data-toggle="modal" data-target="#addressmodal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Residencia</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($employee->employeeAddresses->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Tipo Vivienda</th>
                                <th class="text-center" scope="col">Antiguedad</th>
                                <th class="text-center" scope="col">Dirección</th>
                                <th class="text-center" scope="col">Estrato SocioEconómico</th>
                                <th class="text-center" scope="col">Ciudad</th>
                                <th class="text-center" scope="col">Departamento</th>
                                <th class="text-center" scope="col">Activo</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($employee->employeeAddresses as $employee_address)
                            <tr>
                                <td class="text-center">{{ $employee_address->housing->housing }}
                                </td>
                                <td class="text-center">{{ $employee_address->time_living }} meses</td>
                                <td class="text-center">{{ $employee_address->address }}</td>
                                <td class="text-center">
                                    {{ $employee_address->Stratum->description }}</td>
                                <td class="text-center">{{ $employee_address->city->city }}</td>
                                <td class="text-center">{{ $employee_address->city->province->province }}
                                </td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $employee_address->status])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene direcciones</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
