<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"> <strong>Solicitud de Contrato </strong>
                    @if(!empty($contract->contractRequests))
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $contract->contractRequests[0]->contractRequestStatus->color }}">
                        {{ $contract->contractRequests[0]->contractRequestStatus->name }}
                    </span></h3>
                @endif
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($contract->contractRequests)
                @foreach($contract->contractRequests as $data)
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha Solicitud</th>
                            <th scope="col">Firmado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->is_signed])
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.contract-requests.show', $contract->contractRequests[0]->id)}}"
                                    class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                    <i class="fas fa-search"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                @endif
            </div>
        </div>
    </div>
</div>
