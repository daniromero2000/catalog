@extends('customers::admin.customers.app')
@section('headerCustomer')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clientes</a>
                            </li>
                            <li class="breadcrumb-item active" active aria-current="page">{{ $customer->name}}
                                {{$customer->last_name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('contentCustomer')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <show-customer :customer-id="{{ $customer->id }}"> </show-customer>
</section>
@endsection
@section('scriptsCustomer')

@endsection
