@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que tienes solicitudes de contrato sin aprobar. Los datos de las solicitudes pendientes son los siguientes:</span>
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
                            <th scope="col" class="text-center text-white">Fecha de solicitud</th>
                            <th scope="col" class="text-center text-white">No. de cliente</th>
                            <th scope="col" class="text-center text-white">Nombre de cliente</th>
                            <th scope="col" class="text-center text-white">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $contractRequest)
                        <tr>
                            <td class="blue-dark">{{$contractRequest->created_at->format('M d, Y h:i a') }}</td>
                            <td class="blue-dark">{{$contractRequest->client_identifier}}</td>
                            <td class="blue-dark">{{$contractRequest->customerCompany->company_legal_name}}</td>
                            <td class="blue-dark">{{$contractRequest->contractRequestStatus->name}}</td>
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
                Para gestionar las solicitudes pendientes ingresa al panel administrativo dando
                <a class="btn-redirect-dashboard" href="https://www.xisfo.com/admin/contract-requests">Click en este botón</a>
            </span>
        </div>
    </div>
</div>
@endsection
