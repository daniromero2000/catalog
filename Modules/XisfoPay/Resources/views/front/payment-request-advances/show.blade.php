@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fas fa-file-contract"></i> Préstamos
@endsection
@section('breadcum-item')
Préstamos 
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/slider/side-slider.css')}}">
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @include('generals::layouts.errors-and-messages')
            <div class="card">
                <div class="card-body pt-2">
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
                            @include('xisfopay::front.layouts.payment-request-advances.generals')
                            @include('xisfopay::front.layouts.payment-request-advances.payment')
                        </div>
                        <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                            @include('xisfopay::front.layouts.payment-request-advances.document')
                        </div>
                    </div>
                    @include('generals::layouts.admin.buttons.back_to_index')
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/slider/side-slider.js')}}"></script>
@endsection
