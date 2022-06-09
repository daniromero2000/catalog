<div class="card">
    <div class="card-body">
        <div class="w-100">
            @if($contract->contract_status_id != 3 && $contract->is_aprobed != 1 && $contract->is_signed != 1 &&
            !empty($contract->contractRenewals->where('is_active', 1)->first()))
            @include('xisfopay::front.layouts.contracts.print_contract_button', ['id' =>
            $contract->contractRequests[0]->id])
            @endif
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha Contrato</th>
                            <th scope="col">Firmado / Activo</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center">{{ $contract->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $contract->is_signed]) @include('generals::layouts.status', ['status' =>
                                $contract->is_active])
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
