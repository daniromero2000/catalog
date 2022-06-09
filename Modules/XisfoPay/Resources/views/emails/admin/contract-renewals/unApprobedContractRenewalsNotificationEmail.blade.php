@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que tienes renovaciones de contrato sin aprobar. Los datos de las renovaciones pendientes son los siguientes:</span>
    </div>
</div>
<br>
@endsection
@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-radius: 20px 20px;">
                <table class="table-striped table text-center">
                    <thead class="bg-default">
                        <tr>
                            <th scope="col" class="text-center text-white">Fecha de inicio</th>
                            <th scope="col" class="text-center text-white">Fecha de expiración</th>
                            <th scope="col" class="text-center text-white">No. de cliente</th>
                            <th scope="col" class="text-center text-white">Nombre de cliente</th>
                            <th scope="col" class="text-center text-white">Tarifa de contrato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $contractRenewal)
                        <tr>
                            <td class="blue-dark">{{$contractRenewal->starts->format('M d, Y h:i a') }}</td>
                            <td class="blue-dark">{{$contractRenewal->expires->format('M d, Y h:i a') }}</td>
                            <td class="blue-dark">{{$contractRenewal->contract->contractRequests[0]->client_identifier}}</td>
                            <td class="blue-dark">{{$contractRenewal->contract->contractRequests[0]->customerCompany->company_legal_name}}</td>
                            <td class="blue-dark">{{$contractRenewal->ContractRate->percentage}}</td>
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
                Para gestionar las renovaciones pendientes ingresa al panel administrativo dando
                <a class="btn-redirect-dashboard" href="https://www.xisfo.com/admin/contract-renewals">Click en este botón</a>
            </span>
        </div>
    </div>
</div>
@endsection
