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
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab" data-toggle="tab" href="#home"
                            role="tab" aria-controls="home" aria-selected="true">Agregar Usuarios Disponibles para Servicio {{ $xisfoService['name'] }}</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body">
                        <div class="row align-items-center mb-3">
                            <div class="col">
                                <h3 class="mb-0">Listado de empleados.</h3>
                            </div>
                            <!--<div class="col text-right">
                                <a data-toggle="modal" data-target="#modal"
                                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Agregar Usuario</a>
                            </div>-->
                        </div>
                        <form action="{{ route('admin.xisfo-services.update',$xisfoService->id) }}" method="post" class="form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @foreach($employees as $employee)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" name="employee_id[]" type="checkbox" value="{{ $employee->id }}" id="employee_id"
                                            @if(isset($attachedEmployeesArrayIds) && in_array($employee->id,$attachedEmployeesArrayIds))checked="checked" @endif>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $employee->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
