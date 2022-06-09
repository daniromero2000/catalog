<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Datos de Identificación</h3>
            </div>
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#identitymodal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Agregar Documento</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($employee->employeeIdentities->isNotEmpty())

                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Tipo de Documento</th>
                            <th scope="col">Número</th>
                            <th scope="col">Fecha de Expedición</th>
                            <th scope="col">Ciudad de Expedición</th>
                            <th scope="col">Activo</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($employee->employeeIdentities as $employee_identity)
                        <tr>
                            <td>
                                {{ $employee_identity->identityType->identity_type }}
                            </td>
                            <td>{{ $employee_identity->identity_number }}</td>
                            <td>{{ $employee_identity->expedition_date }}</td>
                            <td>{{ $employee_identity->city->city }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $employee_identity->status])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tiene Identificación</span>
                @endif
                <div class="row mt-3 mx-0">
                    <div class="col text-right">
                        <form action="{{ route('admin.employees.destroy', $employee['id']) }}" method="post"
                            class="form-horizontal">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <div class="btn-group">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
