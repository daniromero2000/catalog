<div class="card">
    <div class="card-header">
        <div class="row align-items-center mb-3">
            <div class="col-6 text-left">
                <h3 class="mb-0" style="color: #1c4393 !important;"> <strong> <i class="far fa-file-alt"></i> Contrato
                    </strong>
                    @if(!empty($contract_request->contract))
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $contract_request->contract->contractStatus->color }}">
                        {{ $contract_request->contract->contractStatus->name }}
                    </span>
                    @endif
                </h3>
            </div>
            <div class="col-6 text-right">
                @if ($contract_request->contract_request_status_id == 3)
                @if (!empty($contract_request->contract->id))
                @include('xisfopay::layouts.contract_requests.front.print_contract_button', ['id' => $contract_request->id])
                <a href="#" data-toggle="modal" data-target="#modalContract{{$contract_request->contract->id}}"
                    class="btn btn-primary btn-sm"><i class="fa fa-print pr-2"></i>
                    Cargar contrato
                </a>
                @include('xisfopay::layouts.contract_requests.front.upload_contract_modal', ['id' => $contract_request->contract->contractRenewals->where('is_active', 1)->last()->id])
                @else
                @endif
                @else
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="w-100">
                <div class="table-responsive">
                    @if(!empty($contract_request->contract))
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Fecha Contrato</th>
                                <th scope="col">Vigencia</th>
                                <th scope="col">Firmado / Activo</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td class="text-center">
                                    {{$contract_request->contract->created_at->format('M d, Y h:i a')}}
                                </td>
                                <td class="text-center">
                                    @if ($contract_request->contract->contractRenewals->where('is_active', 1)->first())
                                    {{$contract_request->contract->contractRenewals->where('is_active', 1)->first()->starts->format('M d, Y h:i a')}}
                                    <strong>/</strong>
                                    {{$contract_request->contract->contractRenewals->where('is_active', 1)->first()->expires->format('M d, Y h:i a')}}
                                    @else
                                    <span>Sin Vigencia</span>
                                    @endif
                                </td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $contract_request->contract->is_signed]) @include('generals::layouts.status',
                                    ['status'
                                    =>
                                    $contract_request->contract->is_active])
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('account.contracts.show', $contract_request->contract_id)}}"
                                        class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                        <i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm">Cliente <strong>aún no</strong> tiene Contrato</span><br>
                    @if (!$contract_request->customer->customerCompanies->isEmpty() &&
                    !$contract_request->customer->customerBankAccounts->isEmpty() &&
                    !$contract_request->customer->customerIdentities->isEmpty())
                    @if ($contract_request->customerCompany->is_aprobed == 1 &&
                    $contract_request->customer->customerIdentities[0]->is_aprobed == 1)                   
                    @else
                    <span class="text-sm"><strong>Aún no</strong> puedes crear Contrato. Es necesario terminar de
                        diligenciar la información complementaria de la Empresa, Identidad, etc. y aprobar su
                        veracidad<br>
                        Estos están ubicados en el apartado <strong>Documentos de Solicitud</strong></span>
                    @endif
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

