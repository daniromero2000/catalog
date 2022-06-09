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
                            <li class="breadcrumb-item active" aria-current="page">{{$contract->id}}</li>
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
            <div class="col pl-0 mb-3">
                <h2 class="text-center p-3 mb-2 bg-secondary">Contrato Persona
                    {{ $contract->contractRequests[0]->customerCompany->constitution_type }}<br>
                    <small>{{ $contract->contractRequests[0]->customerCompany->company_legal_name }} /
                        {{ $contract->contractRequests[0]->customerCompany->company_commercial_name }}</small>
                    <br>
                    <small>{{ $contract->contractRequests[0]->client_identifier }}</small><br>
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $contract->contractStatus->color }}">
                        {{ $contract->contractStatus->name }}
                    </span>
                </h2>
            </div>
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab" data-toggle="tab" href="#home"
                            role="tab" aria-controls="home" aria-selected="true">Información</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0" id="contact-tab" data-toggle="tab" href="#contact"
                            role="tab" aria-controls="contact" aria-selected="false">Seguimiento</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('xisfopay::layouts.contracts.generals')
                    @include('xisfopay::layouts.contracts.contract_request')
                    @include('xisfopay::layouts.contracts.contract_renewals')
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        @include('generals::layouts.admin.commentaries.commentaries', ['datas' =>
                        $contract->contractCommentaries])
                        @include('generals::layouts.admin.statusesLog', ['datas' => $contract->contractStatusesLogs])
                    </div>
                </div>
            </div>
            @include('generals::layouts.admin.buttons.back_to_index')
        </div>
    </div>
    @include('xisfopay::layouts.contracts.edit_contract', ['data' => $contract])
    @include('xisfopay::layouts.contracts.add_comment_modal', ['id' => $contract->id])
    @include('xisfopay::layouts.contracts.add_contract_renewal_modal')
</section>
@endsection
