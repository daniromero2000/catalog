<!-- Emails -->
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Emails</h3>
                </div>
                <div class="col text-right">
                    <a href="#" data-toggle="modal" data-target="#emailmodal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Email</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($employee->employeeEmails->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Tipo</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Fecha Registro</th>
                                <th class="text-center" scope="col">Activo</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($employee->employeeEmails as $employee_email)
                            <tr>
                                <td>{{ $employee_email->email_type }}</td>
                                <td>{{ $employee_email->email }}</td>
                                <td>{{ $employee_email->created_at->format('M d, Y h:i a') }}</td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $employee_email->status])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene Emails</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
