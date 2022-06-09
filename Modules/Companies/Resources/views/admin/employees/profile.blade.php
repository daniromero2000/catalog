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
                <img src="{{asset('img\logo.png')}}" alt="Image placeholder" class="card-img-top">
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
                            <i class="ni location_pin mr-2"></i>{{$employee->employeePosition->position}}
                        </div>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{$employee->subsidiary->name}}
                        </div>
                        <div class="h5 mt-3">
                            <i class="ni business_briefcase-24 mr-2"></i>{{$employee->email}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.employees-profiles.update', $employee->id) }}" method="post" class="form">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="col pl-0 mb-3">
                            <h2>Actualizar Contraseña</h2>
                            <small>La contraseña debe contener por lo menos 8 Caracteres</small>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="password">Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" id="password" placeholder="********"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password-confirm" class="form-control-label">Confirmar
                                        contraseña <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            onchange='check_pass();' placeholder="********" class="form-control">
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
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0">Datos de Identificación</h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if($employee->employeeIdentities->isNotEmpty())

                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Tipo de Documento</th>
                                        <th scope="col">Número</th>
                                        <th scope="col">Fecha de Expedición</th>
                                        <th scope="col">Ciudad de Expedición</th>
                                        <th scope="col">Activo</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($employee->employeeIdentities as $employee_identity)
                                    <tr>
                                        <td>
                                            {{ $employee_identity->identityType->identity_type }}
                                        </td>
                                        <td>{{ $employee_identity->identity_number }}</td>
                                        <td>{{ $employee_identity->expedition_date }}</td>
                                        <td>{{ $employee_identity->city->city }}</td>
                                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                                            $employee_identity->status])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm"><strong>Aún no</strong> tiene Identificación</span>
                            @endif
                            <div class="row mt-3 mx-0">
                                <div class="col text-right">
                                    <form action="{{ route('admin.employees.destroy', $employee['id']) }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0">Contactos de emergencia</h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if($employee->employeeEmergencyContact->isNotEmpty())

                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Nombre</th>
                                        <th class="text-center" scope="col">Teléfono</th>
                                        <th class="text-center" scope="col">Activo</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($employee->employeeEmergencyContact as $employee_emergency_contacts)
                                    <tr>
                                        <td class="text-center">{{ $employee_emergency_contacts->name }}</td>
                                        <td class="text-center">{{ $employee_emergency_contacts->phone }}</td>
                                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                                            $employee_emergency_contacts->status])
                                        </td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm"><strong>Aún no</strong> tiene contactos de emergencia</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Residences -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0">Residencia</h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if($employee->employeeAddresses->isNotEmpty())
                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Tipo Vivienda</th>
                                        <th class="text-center" scope="col">Antiguedad</th>
                                        <th class="text-center" scope="col">Dirección</th>
                                        <th class="text-center" scope="col">Estrato SocioEconómico</th>
                                        <th class="text-center" scope="col">Ciudad</th>
                                        <th class="text-center" scope="col">Departamento</th>
                                        <th class="text-center" scope="col">Activo</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($employee->employeeAddresses as $employee_address)
                                    <tr>
                                        <td class="text-center">{{ $employee_address->housing->housing }}
                                        </td>
                                        <td class="text-center">{{ $employee_address->time_living }} meses</td>
                                        <td class="text-center">{{ $employee_address->address }}</td>
                                        <td class="text-center">
                                            {{ $employee_address->Stratum->description }}</td>
                                        <td class="text-center">{{ $employee_address->city->city }}</td>
                                        <td class="text-center">{{ $employee_address->city->province->province }}
                                        </td>
                                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                                            $employee_address->status])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm"><strong>Aún no</strong> tiene direcciones</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Eps -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0">Datos de Eps</h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if($employee->employeeEpss->isNotEmpty())
                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Eps</th>
                                        <th class="text-center" scope="col">Fecha Registro</th>
                                        <th class="text-center" scope="col">Activo</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($employee->employeeEpss as $employee_eps)
                                    <td class="text-center">{{ $employee_eps->eps->eps}}</td>
                                    <td class="text-center">{{ $employee_eps->created_at->format('M d, Y h:i a')}}</td>
                                    <td class="text-center">@include('generals::layouts.status', ['status' =>
                                        $employee_eps->status])
                                    </td>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm"><strong>Aún no</strong> tiene Eps</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Phones -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0">Teléfonos</h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if($employee->employeePhones->isNotEmpty())
                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Tipo Teléfono</th>
                                        <th class="text-center" scope="col">Teléfono</th>
                                        <th class="text-center" scope="col">Fecha Registro</th>
                                        <th class="text-center" scope="col">Activo</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($employee->employeePhones as $employee_phone)
                                    <tr>
                                        <td>{{ $employee_phone->phone_type }}</td>
                                        <td>{{ $employee_phone->phone }}</td>
                                        <td>{{ $employee_phone->created_at->format('M d, Y h:i a') }}</td>
                                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                                            $employee_phone->status])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm"><strong>Aún no</strong> tiene Teléfonos</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Emails -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0">Emails</h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if($employee->employeeEmails->isNotEmpty())
                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Tipo</th>
                                        <th class="text-center" scope="col">Email</th>
                                        <th class="text-center" scope="col">Fecha Registro</th>
                                        <th class="text-center" scope="col">Activo</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($employee->employeeEmails as $employee_email)
                                    <tr>
                                        <td>{{ $employee_email->email_type }}</td>
                                        <td>{{ $employee_email->email }}</td>
                                        <td>{{ $employee_email->created_at->format('M d, Y h:i a') }}</td>
                                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                                            $employee_email->status])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm"><strong>Aún no</strong> tiene Emails</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
