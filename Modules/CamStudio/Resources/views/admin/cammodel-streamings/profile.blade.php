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
                            <li class="breadcrumb-item " active aria-current="page">Empleados</li>
                            <li class="breadcrumb-item active">Perfil {{$employee->name}}</b> </li>
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
    <div class="row">
        <div class="col-md-4 order-md-last">
            <div class="card card-profile">
                <img src="{{asset('modules/generals/argonTemplate/img/theme/img-1-1000x600.jpg')}}"
                    alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{asset('modules/generals/argonTemplate/img/theme/user.png')}}"
                                    class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-6 pt-md-5 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="text-center">
                        <h5 class="h3">
                            {{$employee->name}} {{$employee->last_name}}
                        </h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{$employee->employeePosition->position}},
                            {{$employee->department[0]->name}}
                        </div>
                        <div class="h5 mt-3">
                            <i class="ni business_briefcase-24 mr-2"></i>{{$employee->email}}
                        </div>
                        {{-- <div>
                            <i class="ni education_hat mr-2"></i>University of Computer Science
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('admin.employee.profile.update', $employee->id) }}" method="post" class="form">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="col pl-0 mb-3">
                            <h2>Actualizar Perfil</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nombre <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Nombre"
                                            class="form-control" value="{!! $employee->name ?: old('name')  !!}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="text" name="email" id="email" validation-pattern="email"
                                            placeholder="Email" class="form-control"
                                            value="{!! $employee->email ?: old('email')  !!}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="password">Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" id="password" placeholder="xxxxx"
                                            class="form-control" value="{!! $employee->phone ?: old('phone')  !!}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-sm">Regresar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
