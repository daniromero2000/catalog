<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">{{ $employee->employeePosition->position }} {{ $employee->name }}
                    {{ $employee->last_name }}</h3>
            </div>
            <div class="col text-right">
                <a data-toggle="modal" data-target="#modal{{ $employee->id }}"
                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Email Usuario</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">RH</th>
                            <th scope="col">Cuenta Bancaria</th>
                            <th scope="col">Roles</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->subsidiary->name }}</td>
                            <td>{{ $employee->rh }}</td>
                            <td>{{ $employee->bank_account }}</td>
                            <td>
                                {{ $employee->roles()->get()->implode('display_name', ', ') }}
                            </td>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Turno</th>
                            <th scope="col">Rota?</th>
                            <th scope="col">Inicio Labores</th>
                            <th scope="col">Última Sesión</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ date('M d, Y h:i a', strtotime($employee->birthday)) }} </td>
                            @if ($employee->shift)
                            <td>{{ $employee->shift->name }}</td>
                            @else
                            <td>Sin Turno</td>
                            @endif
                            <td> @if ($employee->is_rotative == 0) No @endif
                                @if ($employee->is_rotative == 1) Sí @endif</td>
                            <td>{{ date('M d, Y h:i a', strtotime($employee->admission_date)) }}</td>
                            <td>{{ date('M d, Y h:i a', strtotime($employee->last_login_at)) }}</td>
                        </tr>
                    </tbody>
                </table>
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
