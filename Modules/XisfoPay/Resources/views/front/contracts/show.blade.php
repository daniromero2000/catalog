@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fas fa-file-contract"></i> Contratos
@endsection
@section('breadcum-item')
Contratos</span>
@endsection
@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
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
                            @include('xisfopay::front.layouts.contracts.generals')
                            @include('xisfopay::front.layouts.contracts.contract_request')
                            @include('xisfopay::front.layouts.contracts.contract_renewals')
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
            @include('xisfopay::layouts.contracts.add_comment_modal', ['id' => $contract->id])
            @include('xisfopay::layouts.contracts.add_contract_renewal_modal')
        </div>
    </div>
</div>
@endsection
