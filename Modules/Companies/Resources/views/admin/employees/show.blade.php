@php
$fechaActual = strtotime(date("Y-m-d"));
$fechaMayorEdad = date("Y-m-d", strtotime("-18 years", $fechaActual));
@endphp
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Empleados</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$employee->name}}
                                {{$employee->last_name}}</li>
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
                            role="tab" aria-controls="home" aria-selected="true">Empleado</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0" id="profile-tab" data-toggle="tab" href="#profile"
                            role="tab" aria-controls="profile" aria-selected="false">Contacto</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0" id="contact-tab" data-toggle="tab" href="#contact"
                            role="tab" aria-controls="contact" aria-selected="false">Seguimiento</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('companies::layouts.generals')
                    @include('companies::layouts.ids')
                    <div class="row">
                        @include('companies::layouts.epss')
                        @include('companies::layouts.professions')
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        @include('companies::layouts.addresses')
                        @include('companies::layouts.phones')
                        @include('companies::layouts.emails')
                        @include('companies::layouts.contacts')
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        @include('generals::layouts.admin.commentaries', ['datas' => $employee->employeeCommentaries])
                        @include('generals::layouts.admin.statusesLog', ['datas' => $employee->employeeStatusesLogs])
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
    @include('companies::layouts.edit_employee', ['data' => $employee])
    @include('companies::layouts.add_address_modal')
    @include('companies::layouts.add_emergencycontact_modal')
    @include('companies::layouts.add_email_modal')
    @include('companies::layouts.add_phone_modal')
    @include('companies::layouts.add_identity_modal')
    @include('companies::layouts.add_comment_modal')
    @include('companies::layouts.add_eps_modal')
    @include('companies::layouts.add_profession_modal')
</section>
@endsection
