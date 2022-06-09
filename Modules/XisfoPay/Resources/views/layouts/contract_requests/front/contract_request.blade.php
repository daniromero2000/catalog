<div class="card">
    <div class="card-header">
        <div class="row align-items-center mb-3">
            <div class="col-6 text-left">
                <h3 class="mb-0" style="color: #1c4393 !important;"> <i class="far fa-file-alt"></i> Solicitud de servicios </h3>
            </div>
            <div class="col-6 text-right">
                @if ($contract_request->contract_request_status_id == 3)
                    @if (!@isset($contract_request->file))
                    <a download href="{{ route('account.contract-request.generate',$contract_request->id) }}" id="dm" class="btn btn-primary btn-sm" target="_blank">
                        <i class="fa fa-print"></i>
                        Generar solicitud de servicios
                    </a> 
                    @endif
                @include('xisfopay::layouts.contract_requests.front.edit_contract_request_button')
                @endif
            </div>
        </div>
    </div>
    <div class="w-100">
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Identificador</th>
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
                            <a href="#" data-toggle="modal"
                                data-target="#modal-ContractRequestImage{{$contract_request->id}}">
                                <i style="color: #1c4393 !important;" class="fas fa-file-alt"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('xisfopay::layouts.contract_requests.front.contract_request_image', ['data' => $contract_request])
</div>
