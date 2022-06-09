<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col text-center">
                <h3 class="mb-0" style="color: #1C4293"> <i class="fas fa-money-check"></i> Cuentas bancarias</h3>
                <div class="col text-right">
                    <a href="#" data-toggle="modal" data-target="#addBankAccountModal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar cuenta bancaria</a>
                </div>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($customer->customerBankAccounts->isNotEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Banco</th>
                            <th scope="col">Tipo de cuenta / Número</th>
                            <th scope="col">Activo / Aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($customer->customerBankAccounts as $customer_account)
                        <tr>
                            <td>{{ $customer_account->bank->name }}</td>
                            <td>{{ $customer_account->account_type }} /
                                {{ str_repeat("*", 4) . substr($customer_account->account_number, -4) }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $customer_account->is_active]) @include('generals::layouts.status', ['status' =>
                                $customer_account->is_aprobed])
                            </td>
                            <td class="text-center">
                                @if ($customer_account->is_aprobed == 0)
                                <a href="#" data-toggle="modal" data-target="#accountsmodal{{$customer_account->id}}"><i
                                        style="color: #1c4393 !important;" class="fa fa-edit"></i></a>
                                @endif
                                <a href="#" data-toggle="modal" data-target="#modal-bankImage{{$customer_account->id}}">
                                    <i style="color: #1c4393 !important;" class="fas fa-file-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('xisfopay::front.layouts.contract-requests.edit_bank_accounts', ['data' =>
                        $customer_account])
                        @include('xisfopay::layouts.contract_requests.bank_account_image')
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
