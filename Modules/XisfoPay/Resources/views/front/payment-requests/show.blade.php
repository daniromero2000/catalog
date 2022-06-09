@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
Pagos
@endsection
@section('breadcum-item')
Pago
@endsection
@include('generals::layouts.admin.tooltips.tooltipCSS')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/slider/side-slider.css')}}">
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @include('generals::layouts.errors-and-messages')
            {{-- replace card --}}
            <div class="card">
                <div class="card-body">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab" data-toggle="tab" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">Pago</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="document-tab" data-toggle="tab" href="#document"
                                    role="tab" aria-controls="home" aria-selected="false">Comprobantes</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="contact-tab" data-toggle="tab" href="#contact"
                                    role="tab" aria-controls="contact" aria-selected="false">Seguimiento</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @include('xisfopay::front.layouts.payment-requests.generals')
                            @if ($payment_request->is_aprobed == 0 || !$payment_request->paymentRequestAdvances->isEmpty())
                            @include('xisfopay::front.layouts.payment-requests.payment_request_advances')
                            @endif
                            @include('xisfopay::layouts.payment_requests.payment_request_transfers')
                        </div>
                        <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                            @include('xisfopay::front.layouts.payment-requests.document')
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                @include('generals::layouts.admin.commentaries.commentaries', ['datas' =>
                                $payment_request->paymentRequestCommentaries])
                                @include('generals::layouts.admin.statusesLog', ['datas' =>
                                $payment_request->paymentRequestStatusesLogs])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('generals::layouts.admin.files.size_calculatorJS')
<script type="text/javascript" src="{{asset('js/utilities.js')}}"></script>
<script type="text/javascript" src="{{asset('js/slider/side-slider.js')}}"></script>
@endsection
