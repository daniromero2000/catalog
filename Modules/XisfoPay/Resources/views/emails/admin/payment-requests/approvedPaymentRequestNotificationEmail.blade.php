@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que tu solicitud de pago ha sido aprobada. En un
            periodo no mayor a 24 horas se realizará la transferencia, en caso de no recibirlo, comunícate con tu asesor. Los datos
            de la solicitud aprobada son los siguientes:</span>
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
                        {{$paymentRequest->contractRequestStreamAccount->nickname }}
                        {{$paymentRequest->contractRequestStreamAccount->streaming->streaming }} /
                        {{$paymentRequest->contractRequestStreamAccount->contractRequest->client_identifier }}
                    </h6>
                </div>
                <div class="col-sm-12 col-md-6 ml-auto text-center">
                    <h6>Fecha de solicitud de pago: {{$paymentRequest->created_at->format('M d, Y h:i a')}}</h6>
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
                            <th scope="col" class="text-center text-white">TRM</th>
                            <th scope="col" class="text-center text-white">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="blue-dark">${{number_format($paymentRequest->usd_amount, 2)}} USD</td>
                            <td class="blue-dark">${{number_format($paymentRequest->trm, 2)}}</td>
                            <td class="blue-dark">${{number_format($paymentRequest->grand_total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left mt-3">
            <span style="font-size: .90rem; color:black;">
                Para ver tu solicitud en tu panel administrativo:
                <a target="_blank" class="btn-redirect-dashboard"
                    href="{{url('https://www.xisfo.com/account/payment-requests/'.$paymentRequest->id)}}">Click aquí</a>
            </span>
        </div>
    </div>
</div>
@endsection
