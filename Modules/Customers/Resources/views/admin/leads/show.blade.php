@extends('generals::layouts.admin.app')
@section('module-name')
    Ver lead |
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">Leads</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$lead->name}}
                                {{$lead->last_name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
<section class="content">
    <div class="row row-reset w-100">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-reset w-100">
                        <div class="col-12 col-md-12 m-auto text-center">
                            <img src="{{asset('modules/generals/argonTemplate/img/theme/lead-user.png')}}" alt="">
                            <h3 class="mb-0">{{ $lead->name }}
                                {{ $lead->last_name }} 
                            </h3>
                            <h3>
                                <span class="badge" style="color: #ffffff; background-color: {{ $lead->leadStatus->color }}">
                                    {{ $lead->leadStatus->name }}
                                </span>
                            </h3>
                            <div class="col text-right">
                                <a data-toggle="modal" data-target="#modal{{ $lead->id }}"
                                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row row-reset-w-100 mt-4">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="row row-reset w-100">
                                <div class="col-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row row-reset w-100">
                                                <div class="col-12 col-md-12">
                                                    <h3>Datos de contacto <i class="fas fa-id-card-alt"></i></h3>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table-striped table align-items-center table-flush table-hover text-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">CORREO ELECTRÓNICO</th>
                                                            <th scope="col">TELÉFONO / WHATSAPP</th>
                                                            <th scope="col">CIUDAD</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <tr>
                                                            <td>{{ $lead->email }}</td>
                                                            <td>{{ $lead->phone }}</td>
                                                            <td>{{ $lead->city->city }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row row-reset w-100">
                                <div class="col-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row row-reset w-100">
                                                <div class="col-12 col-md-12">
                                                    <h3>Datos de compañía <i class="fas fa-building"></i></h3>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table-striped table align-items-center table-flush table-hover text-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">EMPRESA</th>
                                                            <th scope="col">SUCURSAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <tr>
                                                            <td>{{ $lead->phone }}</td>
                                                            <td>{{ $lead->phone }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row row-reset w-100">
                                <div class="col-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row row-reset w-100">
                                                <div class="col-12 col-md-12">
                                                    <h3>Datos de intención <i class="fas fa-chalkboard-teacher"></i></h3>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table-striped table align-items-center table-flush table-hover text-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">CANAL</th>
                                                            <th scope="col">SERVICIO</th>
                                                            <th scope="col">MOTIVO DE REGISTRO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <tr>
                                                            <td>{{ $lead->leadChannel->channel }}</td>
                                                            <td>{{ $lead->service->service }}</td>
                                                            <td>{{ $lead->leadReason->reason }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="row">
                                <div class="row row-reset w-100">
                                    <div class="col-12 col-md-12">
                                        @include('generals::layouts.admin.commentaries', ['datas' => $lead->commentaries])
                                    </div>
                                </div>
                                <div class="row row-reset w-100">
                                    <div class="col-12 col-md-12">
                                        @include('generals::layouts.admin.statusesLog', ['datas' => $lead->leadStatusesLogs])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customers::layouts.leads.edit_lead', ['data' => $lead])
    @include('customers::layouts.leads.add_comment_modal')
@endsection
