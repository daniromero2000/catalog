<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col text-center">
                <h3 class="mb-0" style="color: #1C4293"> <strong> <i class="far fa-file-alt"></i> Información de contrato </strong>
                    @if(!empty($contract_request->contract))
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $contract_request->contract->contractStatus->color }}">
                        {{ $contract_request->contract->contractStatus->name }}
                    </span>
                </h3>
                @if($contract_request->contract->contract_status_id != 3 && $contract_request->contract->is_aprobed != 1
                && $contract_request->contract->is_signed != 1 &&
                !empty($contract_request->contract->contractRenewals->where('is_active', 1)->first()))
                @include('xisfopay::front.layouts.contracts.print_contract_button', ['id' => $contract_request->id])
                @endif
                @endif
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($contract_request->contract)
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
                            <td class="text-center">{{$contract_request->contract->created_at->format('M d, Y h:i a')}}
                            </td>
                            <td class="text-center">
                                @if ($contract_request->contract->contractRenewals->where('is_active', 1)->first())
                                {{$contract_request->contract->contractRenewals->where('is_active', 1)->first()->starts->format('M d, Y h:i a')}}
                                <strong>/</strong>
                                {{$contract_request->contract->contractRenewals->where('is_active', 1)->first()->expires->format('M d, Y h:i a')}}
                                @else
                                <span>Sin vigencia</span>
                                @endif
                            </td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $contract_request->contract->is_signed]) @include('generals::layouts.status', ['status' =>
                                $contract_request->contract->is_active])
                            </td>
                            <td class="text-center">
                                <a href="{{ route('account.contracts.show', $contract_request->contract_id)}}"
                                    class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                    <i style="color: #1c4393 !important;" class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tienes contrato, completa tu solicitud para activar tu contrato.</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
