@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que tienes contratos  <span class="btn-expired-alert">INACTIVOS</span></span>
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
                            <th scope="col" class="text-center text-white">Fecha de registro</th>
                            <th scope="col" class="text-center text-white">No. de cliente</th>
                            <th scope="col" class="text-center text-white">Nombre de cliente</th>
                            <th scope="col" class="text-center text-white">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $contract)
                        <tr>
                            <td class="blue-dark">{{$contract->created_at->format('M d, Y h:i a') }}</td>
                            <td class="blue-dark">{{$contract->ContractRequests[0]->client_identifier}}</td>
                            <td class="blue-dark">{{$contract->contractRequests[0]->customerCompany->company_legal_name}}</td>
                            <td class="blue-dark">{{$contract->contractStatus->name}}</td>
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
                Para gestionar los contratos pendientes ingresa al panel administrativo dando
                <a class="btn-redirect-dashboard" href="https://www.xisfo.com/admin/contracts">Click aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
