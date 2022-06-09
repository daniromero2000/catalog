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
                            <li class="breadcrumb-item"><a href="{{ route('admin.contract-request-stream-accounts.index') }}">Plataformas Clientes</a>
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
                            role="tab" aria-controls="home" aria-selected="true">Candidato</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0" id="contact-tab" data-toggle="tab" href="#contact"
                            role="tab" aria-controls="contact" aria-selected="false">Seguimiento</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('companies::layouts.interview_generals')
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        @include('generals::layouts.admin.commentaries', ['datas' => $interview->interviewCommentaries])
                    </div>
                </div>
            </div>
            @include('generals::layouts.admin.buttons.back_to_index')
        </div>
    </div>
    {{-- @include('companies::layouts.edit_interview', ['data' => $interview]) --}}
</section>
@endsection
