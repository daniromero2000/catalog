@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que se ha registrado una nueva solicitud de
            contrato. Los datos de la solicitud registrada son los siguientes:</span>
    </div>
</div>
<br>
@endsection
@section('content')
<div class="mx-auto mt-1" style="width: 95%;">
    <div class="card card-invoice">
        <div class="card-header text-center">
            <div class="row">
                <div class="col-sm-12 col-md-6 text-center">
                    <h6>
                        Solicitud de contrato: {{$contractRequest->id}}
                    </h6>
                </div>
                <div class="col-sm-12 col-md-6 ml-auto text-center">
                    <h6>Fecha de solicitud: {{$contractRequest->created_at->format('M d, Y h:i a')}}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-radius: 20px 20px 0px 0px; border: dotted 1px gray;">
                <table class="table-striped table text-center">
                    <thead class="bg-default">
                        <tr>
                            <th scope="col" class="text-center text-white">Fecha de solicitud</th>
                            <th scope="col" class="text-center text-white">No. de cliente</th>
                            <th scope="col" class="text-center text-white">Nombre de cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="blue-dark">{{$contractRequest->created_at->format('M d, Y h:i a') }}</td>
                            <td class="blue-dark">{{$contractRequest->client_identifier }}</td>
                            <td class="blue-dark">{{$contractRequest->customer->name}}
                                {{$contractRequest->customer->last_name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left mt-3">
            <span style="font-size: .90rem; color:black;">
                Para gestionar la nueva solicitud ingresa al panel administrativo dando
                <a target="_blank" class="btn-redirect-dashboard"
                    href="https://www.xisfo.com/admin/contract-requests">Click aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
