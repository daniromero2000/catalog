<div class="card">
    <div class="card-header">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Solicitud </h3>
            </div>
            @if ($contract_request->is_aprobed != 1)
            @include('xisfopay::layouts.contract_requests.admin.edit_contract_request_button')
            @endif
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
    @if (auth()->guard('employee')->user()->hasRole('superadmin|xisfopay_assistant'))
    @if ($enable_create == 1)
    <div class="card-footer text-right">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.customer-new-contract-request', $contract_request->customer->id) }}" aria-expanded="false" aria-controls="contentId">
            Crear nueva solicitud
        </a>
    </div>
    @endif
    @endif
    @include('xisfopay::layouts.contract_requests.admin.contract_request_image', ['data' => $contract_request])
</div>
