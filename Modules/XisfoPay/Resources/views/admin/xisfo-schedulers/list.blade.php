@extends('generals::layouts.admin.app')
@section('styles')
    <style>
        .id_employees{
            display: none;
        }
    </style>
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item " active aria-current="page">{{$module}}</li>
                            <li class="breadcrumb-item active">Crear Cita Xisfo</li>
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
            @csrf
            <div class="col pl-0 mb-3">
                <h2>Crear Cita Xisfo</h2>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-control-label" for="service">Nombre del Servicio para la Cita<span
                                class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-th-list"></i></span>
                            </div>
                            <select name="service" id="service" class="form-control" onchange="changeService()">
                                <option disabled selected value> -- Selecciona una opción -- </option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="id_employees" class="col-sm-6 id_employees">
                    <div class="form-group">
                        <label class="form-control-label" for="id_employee">Escoger el Asesor<span
                                class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <select class="form-control" name="id_employee" id="id_employee" required onchange="addUrl()">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right" id="content_btn_scheduler">
        </div>
    </div>
    @include('xisfopay::admin.xisfo-schedulers.validate_service')
</section>
@endsection
