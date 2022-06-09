<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0" style="color: #1c4393 !important;"> <i class="fas fa-university"></i> Cuentas bancarias</h3>
            </div>
            <div class="col text-right">
                @if ($contract_request->contract_request_status_id == 7 || $contract_request->contract_request_status_id == 5 )
                <a href="#" data-toggle="modal" data-target="#addBankAccountModal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Agregar cuenta bancaria</a>
                @endif
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($customer->customerBankAccounts->isNotEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Banco</th>
                            <th scope="col">Cuenta</th>
                            <th scope="col">Activo - Inactivo / Aprobado - No aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($customer->customerBankAccounts as $customer_account)
                        <tr>
                            <td>{{ $customer_account->bank->name }}</td>
                            <td>{{ $customer_account->account_type }} / {{ str_repeat("*", strlen($customer_account->account_number)-4) . substr($customer_account->account_number, -4) }}
                            </td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $customer_account->is_active]) @include('generals::layouts.status', ['status' =>
                                $customer_account->is_aprobed])
                            </td>
                            <td class="text-center">
                                @if ($contract_request->contract_request_status_id == 7)
                                <a href="#" data-toggle="modal" data-target="#accountsmodal{{$customer_account->id}}"><i
                                        class="fa fa-edit"></i></a>
                                @else
                                @endif
                                <a href="#" data-toggle="modal" data-target="#modal-bankImage{{$customer_account->id}}">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('xisfopay::layouts.contract_requests.front.edit_bank_accounts', ['data' =>
                        $customer_account])
                        @include('xisfopay::layouts.contract_requests.front.bank_account_image')
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tienes cuentas bancarias registradas</span>
                @endif
            </div>
        </div>
    </div>
</div>
