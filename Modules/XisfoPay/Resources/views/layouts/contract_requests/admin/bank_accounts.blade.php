<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Datos Cuentas Bancarias</h3>
            </div>
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#addBankAccountModal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Agregar Cuenta Banco</a>
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
                            <th scope="col">Activo / Aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($customer->customerBankAccounts as $customer_account)
                        <tr>
                            <td>{{ $customer_account->bank->name }}</td>
                            <td>{{ $customer_account->account_type }} / {{ $customer_account->account_number }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $customer_account->is_active]) @include('generals::layouts.status', ['status' =>
                                $customer_account->is_aprobed])
                            </td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-target="#accountsmodal{{$customer_account->id}}"><i
                                        class="fa fa-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target="#modal-bankImage{{$customer_account->id}}">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('xisfopay::layouts.contract_requests.admin.edit_bank_accounts', ['data' =>
                        $customer_account])
                        @include('xisfopay::layouts.contract_requests.admin.bank_account_image')
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tiene Identificación</span>
                @endif
            </div>
        </div>
    </div>
</div>
