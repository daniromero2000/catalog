@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que tienes transferencias bancarias sin
            realizar</span>
    </div>
</div>
<br>
@endsection
@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-radius: 20px 20px 0px 0px; border: dotted 1px gray;">
                <table class="table-striped table text-center">
                    <thead class="bg-default">
                        <tr>
                            <th scope="col" class="text-center text-white">Fecha</th>
                            <th scope="col" class="text-center text-white">Cliente</th>
                            <th scope="col" class="text-center text-white">Valor</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $bankTransfers)
                        <tr>
                            <td class="blue-dark">{{$bankTransfers->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">
                                    {{ $bankTransfers->paymentRequest->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name}}
                                    / {{ $bankTransfers->paymentRequest->contractRequestStreamAccount->nickname}} /
                                    {{ $bankTransfers->paymentRequest->contractRequestStreamAccount->streaming->streaming}} </td>
                            <td class="blue-dark">$ {{number_format($bankTransfers->value) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left mt-3">
            <span style="font-size: .90rem; color:black;">
                Para gestionar las transferencias pendientes ingresa al panel administrativo dando
                <a class="btn-redirect-dashboard" href="https://www.xisfo.com/admin/payment-bank-transfers">Click
                    aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
