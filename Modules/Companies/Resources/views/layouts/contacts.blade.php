<!-- Residences -->
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Contactos de emergencia</h3>
                </div>
                <div class="col text-right">
                    <a href="# " data-toggle="modal" data-target="#emergencycontactmodal"
                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                        Agregar Contactos de emergencia</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($employee->employeeEmergencyContact->isNotEmpty())

                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Nombre</th>
                                <th class="text-center" scope="col">Teléfono</th>
                                <th class="text-center" scope="col">Activo</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($employee->employeeEmergencyContact as $employee_emergency_contacts)
                            <tr>
                                <td class="text-center">{{ $employee_emergency_contacts->name }}</td>
                                <td class="text-center">{{ $employee_emergency_contacts->phone }}</td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $employee_emergency_contacts->status])
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene contactos de emergencia</span>
                    @endif

                </div>
            </div>

        </div>

    </div>
</div>
