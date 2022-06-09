@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">@include('generals::layouts.admin.breadcrumbs.index_options')
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$payment_request_advance->id}}
                                </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/slider/side-slider.css')}}">
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab" data-toggle="tab" href="#home"
                            role="tab" aria-controls="home" aria-selected="true">Préstamo</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0" id="document-tab" data-toggle="tab" href="#document"
                            role="tab" aria-controls="home" aria-selected="false">Comprobantes</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('xisfopay::layouts.payment_request_advances.generals')
                </div>
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                    @include('xisfopay::layouts.payment_request_advances.document')
                </div>

            </div>
            @include('generals::layouts.admin.buttons.back_to_index')
            @include('xisfopay::layouts.payment_request_advances.add_transfer_modal')
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0"><strong>Pago: </strong> {{$payment_request_advance->paymentRequest->contractRequestStreamAccount->nickname }} /
                        {{$payment_request_advance->paymentRequest->contractRequestStreamAccount->streaming->streaming }}
                        <span class="badge"
                            style="color: #ffffff; background-color: {{ $payment_request_advance->paymentRequest->paymentRequestStatus->color }}">
                            {{ $payment_request_advance->paymentRequest->paymentRequestStatus->name }}
                        </span></h3>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Total en Pesos</th>
                                <th scope="col">Aprobado</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td class="text-center">{{ $payment_request_advance->paymentRequest->created_at->format('M d, Y h:i a') }}</td>
                                @if ($payment_request_advance->paymentRequest->payment_type == "2")
                                <td class="text-center">{{ number_format($payment_request_advance->paymentRequest->usd_amount, 0) }} TKS</td>
                                @else
                                <td class="text-center">{{ number_format($payment_request_advance->paymentRequest->usd_amount, 2) }} TKS</td>
                                @endif
                                @if ($payment_request_advance->paymentRequest->grand_total < 0) <td class="text-center" style="color: red;">
                                    $ {{ number_format(round($payment_request_advance->paymentRequest->grand_total)) }} </td>
                                @else
                                <td class="text-center">$ {{ number_format(round($payment_request_advance->paymentRequest->grand_total)) }}</td>
                                @endif
                                <td class="text-center">
                                    @include('generals::layouts.status', ['status' =>
                                    $payment_request_advance->paymentRequest->is_aprobed])
                                </td>
                                <td class="text-center"><a
                                    href="{{route('admin.payment-requests.show', $payment_request_advance->paymentRequest->id)}}"><i
                                        class="fas fa-eye text-primary"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @include('xisfopay::layouts.payment_request_advances.edit_payment_request_advance', ['data' => $payment_request_advance])
</section>
<script type="text/javascript" src="{{asset('js/slider/side-slider.js')}}"></script>
@endsection
