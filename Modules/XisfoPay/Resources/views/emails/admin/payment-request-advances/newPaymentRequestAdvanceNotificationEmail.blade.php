@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que se ha solicitado un prestamo.</span>
    </div>
</div>
<br>
@endsection
@section('content')
<div class="mx-auto mt-1" style="width: 95%;">
    <div class="card card-invoice">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-6 text-center">
                    <h6>
                        Cuenta master:
                        {{$paymentRequestAdvance->paymentRequest->contractRequestStreamAccount->nickname }}
                        {{$paymentRequestAdvance->paymentRequest->contractRequestStreamAccount->streaming->streaming }} /
                        {{$paymentRequestAdvance->paymentRequest->contractRequestStreamAccount->contractRequest->client_identifier }}
                    </h6>
                </div>
                <div class="col-sm-12 col-md-6 ml-auto text-center">
                    <h6>Fecha de solicitud de prestamo: {{$paymentRequestAdvance->created_at->format('M d, Y h:i a')}}</h6>
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
                            <th scope="col" class="text-center text-white">Monto</th>
                            <th scope="col" class="text-center text-white">Nombre de cliente</th>
                            <th scope="col" class="text-center text-white">Cuenta master</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="blue-dark">${{number_format($paymentRequestAdvance->value, 2)}} USD/TOKENS</td>
                            <td class="blue-dark">{{$paymentRequestAdvance->paymentRequest->contractRequestStreamAccount->nickname }}</td>
                            <td class="blue-dark">
                                {{$paymentRequestAdvance->paymentRequest->contractRequestStreamAccount->streaming->streaming }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left mt-3">
            <span style="font-size: .90rem; color:black;">
                Para gestionar el prestamo ingresa al panel administrativo dando
                <a target="_blank" class="btn-redirect-dashboard"
                    href="{{url('https://www.xisfo.com/admin/payment-request-advances/'.$paymentRequestAdvance->id)}}">Click aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
