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
                            <li class="breadcrumb-item active" aria-current="page">{{$payment_cut->id}}
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
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('xisfopay::layouts.payment_cuts.generals')
                    @forelse ($chaseTransfers as $key => $chaseTransfer)
                        @include('xisfopay::layouts.payment_cuts.chase_transfers')
                    @empty
                        @include('xisfopay::layouts.payment_cuts.payment_requests', ['chaseTransfer' => $payment_cut->paymentRequests])
                    @endforelse
                </div>
            </div>
            <div class="row ml-4 mb-4">
                <a href="{{ route($optionsRoutes . '.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
    {{-- @include('xisfopay::layouts.contracts.add_comment_modal', ['id' => $payment_cut->id]) --}}
    @include('xisfopay::layouts.payment_cuts.edit_payment_cut', ['data' =>
    $payment_cut])
    @include('xisfopay::layouts.payment_cuts.add_payment_request_modal', ['paymentCut' =>
    $payment_cut])
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/utilities.js')}}"></script>
@endsection
