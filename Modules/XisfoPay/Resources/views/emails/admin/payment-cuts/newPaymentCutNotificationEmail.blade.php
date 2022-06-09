@extends('xisfopay::emails.admin.layouts.app-mail')
@section('header-notification-especific')
<div class="row mt-4">
    <div class="col-md-12 text-left">
        <span style="font-size: 20px; color:black;">¡Cordial saludo!</span>
        <br>
        <span style="font-size: .90rem; color:black;">Te informamos que se ha registrado un nuevo corte de pago. Los
            datos del corte son los siguientes:</span>
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
                        Corte de pago: {{$paymentCut->id}}
                    </h6>
                </div>
                <div class="col-sm-12 col-md-6 ml-auto text-center">
                    <h6>Fecha de corte de pago: {{$paymentCut->created_at->format('M d, Y h:i a')}}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 text-center">
                    <h6>
                        <h6>TRM:</h6>
                    </h6>
                </div>
                <div class="col-sm-12 col-md-6 ml-auto text-center">
                    {{$paymentCut->trm}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-radius: 20px 20px 0px 0px; border: dotted 1px gray;">
                @if($paymentCut->paymentRequests)
                <table class="table-striped table text-center">
                    <thead class="bg-default">
                        <tr>
                            <th scope="col" class="text-center text-white">Fecha</th>
                            <th scope="col" class="text-center text-white">Plataforma</th>
                            <th scope="col" class="text-center text-white">Monto USD</th>
                            <th scope="col" class="text-center text-white">TRM</th>
                            <th scope="col" class="text-center text-white">Comisión</th>
                            <th scope="col" class="text-center text-white">Prestamos</th>
                            <th scope="col" class="text-center text-white">Subtotal</th>
                            <th scope="col" class="text-center text-white">4x1000</th>
                            <th scope="col" class="text-center text-white">Total</th>
                            <th scope="col" class="text-center text-white">Ganancia en Pesos</th>
                            <th scope="col" class="text-center text-white">Factura en Dolares</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentCut->paymentRequests as $data)
                        <tr>
                            <td class="text-center blue-dark">{{$data->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center blue-dark">
                                {{$data->contractRequestStreamAccount->nickname }}{{$data->contractRequestStreamAccount->streaming->streaming }}
                                {{ $data->contractRequestStreamAccount->contractRequest->client_identifier }}
                            </td>
                            <td class="text-center blue-dark">{{ number_format($data->usd_amount, 2) }}</td>
                            <td class="text-center blue-dark">${{ number_format($data->trm, 2) }}</td>
                            <td class="text-center blue-dark">{{ number_format($data->commission, 2)}}</td>
                            <td class="text-center blue-dark">${{ number_format($data->advances, 2) }}</td>
                            <td class="text-center blue-dark">${{ number_format($data->subtotal, 2) }}</td>
                            <td class="text-center blue-dark">${{ number_format($data['4x1000'], 2) }}</td>
                            @if ($data->grand_total < 0) <td class="text-center blue-dark" style="color: red;">
                                ${{ number_format($data->grand_total, 2) }}</td>
                                @else
                                <td class="text-center blue-dark">${{ number_format($data->grand_total, 2) }}</td>
                                @endif
                                <td class="text-center blue-dark">${{ number_format($data->real_gain, 2) }}</td>
                                <td class="text-center blue-dark">${{ number_format($data->usd_gain, 2) }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <span class="text-sm">No tienes cortes de pago</span><br>
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-left">
            <span style="font-size: .90rem; color:black;">
                Para gestionar los cortes de pendientes ingresa al panel administrativo dando
                <a target="_blank" class="btn-redirect-dashboard" href="https://www.xisfo.com/admin/payment-cuts">Click
                    en este botón</a>
            </span>
        </div>
    </div>
</div>
@endsection
