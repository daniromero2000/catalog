<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">{{ $interview->name }}
                    {{ $interview->last_name }} {{$interview->identification_number}} Candidato a:
                    {{ $interview->employeePosition->position }} <span class="badge"
                        style="color: #ffffff; background-color: {{ $interview->interviewStatus->color }}">
                        {{ $interview->interviewStatus->name }}
                    </span></h3>
            </div>
            <div class="col text-right">
                <a data-toggle="modal" data-target="#modal{{ $interview->id }}"
                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Email Usuario</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $interview->email }}</td>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ date('M d, Y h:i a', strtotime($interview->birthday)) }} </td>
                            <td>{{ $interview->phone }}</td>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Dirección</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $interview->address }}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- <div class="row mt-3 mx-0">
                    <div class="col text-right">
                        <form action="{{ route('admin.interview.destroy', $interview['id']) }}" method="post"
                class="form-horizontal">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <div class="btn-group">
                </div>
                </form>
            </div>
        </div> --}}
    </div>
</div>
</div>
</div>
