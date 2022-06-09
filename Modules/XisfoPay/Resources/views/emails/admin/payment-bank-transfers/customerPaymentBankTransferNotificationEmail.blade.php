@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que se ha realizado una transferencia
            bancaria</span>
    </div>
</div>
<br>
@endsection
@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-radius: 20px 20px 0px 0px; border: dotted 1px gray;">
                <table class="table-striped table align-items-center table-flush table-hover">
                    <thead class="bg-default">
                        <tr>
                            <th scope="col" class="text-center text-white">Fecha</th>
                            <th scope="col" class="text-center text-white">Cuenta</th>
                            <th scope="col" class="text-center text-white">Cuenta</th>
                            <th scope="col" class="text-center text-white">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">{{ $data->paymentRequest->contractRequestStreamAccount->nickname}}
                            </td>
                            <td class="text-center">
                                {{ $data->paymentRequest->contractRequestStreamAccount->contractRequest->customer->customerBankAccounts->where('is_default', 1)->first()->bank->name}}
                                /
                                {{ str_repeat("*", strlen($data->paymentRequest->contractRequestStreamAccount->contractRequest->customer->customerBankAccounts->where('is_default', 1)->first()->account_number)-4) . substr($data->paymentRequest->contractRequestStreamAccount->contractRequest->customer->customerBankAccounts->where('is_default', 1)->first()->account_number, -4) }}
                            </td>
                            <td class="text-center">${{ number_format($data->value, 2) }}</td>
                        </tr>
                    <tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left">
            <span style="font-size: .90rem; color:black;">
                Para verificar tus transferencias ingresa al panel administrativo dando
                <a class="btn-redirect-dashboard" href="https://www.xisfo.com/account/payment-bank-transfers">Click aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
