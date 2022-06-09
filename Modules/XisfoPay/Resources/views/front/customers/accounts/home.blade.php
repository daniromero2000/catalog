@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fab fa-firstdraft"></i></i> Inicio
@endsection
@section('breadcum-item')
Inicio
@endsection
@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Light table -->
                <div class="table-responsive">
                    <img class="w-100" style="border-radius: 20px;" src="{{ asset('img/xisfopay/home-dashboard.png') }}"
                        alt="Xisfo Pay Services">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
