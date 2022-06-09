@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que tienes <span
                class="btn-expired-alert">NUEVAS</span> Transferencias Bancarias aprobadas</span>
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
                            <th scope="col" class="text-center text-white">Plataforma Cliente</th>
                            <th scope="col" class="text-center text-white">Cuenta Bancaria</th>
                            <th scope="col" class="text-center text-white">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">{{ $data->paymentRequest->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name}}
                                {{ $data->paymentRequest->contractRequestStreamAccount->nickname}}
                                {{ $data->paymentRequest->contractRequestStreamAccount->streaming->streaming}}
                            </td>
                            <td class="text-center">
                                {{ $data->paymentRequest->customerBankAccount->bankNames->name}}
                                {{ $data->paymentRequest->customerBankAccount->account_type}} /
                                {{ $data->paymentRequest->customerBankAccount->account_number}}
                            </td>
                            <td class="text-center">${{ number_format($data->value, 2) }}</td>
                        </tr>
                        @endforeach
                    <tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left">
            <span style="font-size: .90rem; color:black;">
                Para gestionar los contratos pendientes ingresa al panel administrativo dando
                <a class="btn-redirect-dashboard" href="https://www.xisfo.com/admin/payment-bank-transfers">Click aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
