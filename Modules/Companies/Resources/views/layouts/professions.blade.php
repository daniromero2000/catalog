<!-- Professions -->
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Profesiones</h3>
                </div>
                <div class="col text-right">
                    <a href="#" data-toggle="modal" data-target="#professionmodal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Profesion</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($employee->employeeProfessions->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Profesión</th>
                                <th scope="col">Fecha Registro</th>
                                <th scope="col">Activo</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($employee->employeeProfessions as $employee_profession)
                            <tr>
                                <td>{{ $employee_profession->professionsList->profession }}</td>
                                <td>{{ $employee_profession->created_at->format('M d, Y h:i a') }}</td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $employee_profession->status])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene profesiones</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
