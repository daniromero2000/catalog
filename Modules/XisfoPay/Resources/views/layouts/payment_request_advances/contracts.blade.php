<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                @if(!empty($contract_request->contract))
                <h3 class="mb-0"> <strong>Contrato </strong> {{ $contract_request->contract->id }}
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $contract_request->contract->contractStatus->color }}">
                        {{ $contract_request->contract->contractStatus->name }}
                    </span>
                </h3>
                <div class="col text-right">
                    <a href="{{ route('admin.contracts.show', $contract_request->contract_id)}}"
                        class="btn btn-primary text-white btn-sm"><i class="fa fa-search"></i> Ver Contrato</a>
                </div>
                @endif
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($contract_request->contract)
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Firmado</th>
                            <th scope="col">Activo</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $contract_request->contract->is_signed])
                            </td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $contract_request->contract->is_active])
                            </td>
                            <td class="text-center">{{$contract_request->contract->created_at->format('M d, Y h:i a')}}</td>
                        </tr>
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tiene Contrato</span><br>
                @if ($contract_request->is_signed == 1 && $contract_request->contract_request_status_id == 5)
                <div class="col text-right">
                    <a href="#" data-toggle="modal" data-target="#contractmodal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Contrato</a>
                </div>
                @else
                <span class="text-sm"><strong>Aún no</strong> puedes crear Contrato</span>
                @endif
                @endif
                <div class="row mt-3 mx-0">
                    <div class="col text-right">
                        <form action="{{ route('admin.contract-requests.destroy', $contract_request['id']) }}"
                            method="post" class="form-horizontal">
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
