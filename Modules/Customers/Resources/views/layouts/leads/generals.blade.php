<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">{{ $lead->name }}
                    {{ $lead->last_name }} <span class="badge" style="color: #ffffff; background-color: {{ $lead->leadStatus->color }}">
                        {{ $lead->leadStatus->name }}
                    </span></h3>
            </div>
            <div class="col text-right">
                <a data-toggle="modal" data-target="#modal{{ $lead->id }}"
                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Canal</th>
                            <th scope="col">Servicio</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->phone }}</td>
                            <td>{{ $lead->city->city }}</td>
                            <td>{{ $lead->leadChannel->channel }}</td>
                            <td>{{ $lead->service->service }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3 mx-0">
                    <div class="col text-right">
                        <form action="{{ route('admin.leads.destroy', $lead['id']) }}" method="post"
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
