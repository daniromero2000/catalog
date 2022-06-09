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
                            <li class="breadcrumb-item active" aria-current="page">{{$payment_request->id}}
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
                    @include('xisfopay::layouts.payment_requests.generals')
                    @if ($payment_request->is_aprobed == 0 || !$payment_request->paymentRequestAdvances->isEmpty())
                    @include('xisfopay::layouts.payment_requests.payment_request_advances')
                    @endif
                    @include('xisfopay::layouts.payment_requests.payment_request_transfers')
                </div>
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                    @include('xisfopay::layouts.payment_requests.document')
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
            @include('generals::layouts.admin.buttons.back_to_index')
        </div>
    </div>
    @include('xisfopay::layouts.payment_requests.add_comment_modal', ['id' => $payment_request->id])
    @include('xisfopay::layouts.payment_requests.edit_payment_request', ['data' =>
    $payment_request])
    @include('xisfopay::layouts.payment_requests.add_advance_modal')
</section>
<script type="text/javascript" src="{{asset('js/slider/side-slider.js')}}"></script>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
