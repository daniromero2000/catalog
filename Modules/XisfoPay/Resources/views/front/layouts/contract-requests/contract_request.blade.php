<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col text-center">
                <h3 class="mb-0" style="color: #1C4293"> <i class="far fa-file-alt"></i> Datos de solicitud de servicios </h3>
            </div>
            @if ($contract_request->is_aprobed != 1)
            @include('xisfopay::layouts.contract_requests.edit_contract_request_button')
            @endif
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Identificador de cliente</th>
                            <th scope="col">Firmado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center"> {{$contract_request->client_identifier}}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $contract_request->is_signed])
                            </td>
                            <td class="text-center">{{$contract_request->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-target="#modal-ContractRequestImage{{$contract_request->id}}">
                                    <i style="color: #1c4393 !important;" class="fas fa-file-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('xisfopay::layouts.contract_requests.contract_request_image', ['data' => $contract_request])
</div>
