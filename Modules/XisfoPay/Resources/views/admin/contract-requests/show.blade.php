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
                            <li class="breadcrumb-item active" aria-current="page">{{$contract_request->id}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#image-comp .hidden-button a{
    display:none;
}
#image-comp .hidden-button:hover a{
    display:inline;
}
</style>
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="row row-reset w-100">
                <div class="col-12 col-md-12">
                    <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-12 col-xl-3 m-auto text-center">
                            <div>
                                <img style="max-height: 200px; max-width: 200px;" src="{{asset("img/xisfopay/logo-xisfo-pay-services.png")}}" alt="Logo Xisfo Pay">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-xl-6 m-auto">
                            <h2 class="text-center p-3 mb-2">Solicitud de Servicios
                                @if ($contract_request->customer->customerCompanies)
                                Persona {{ $contract_request->customerCompany->constitution_type }}<br>
                                <small>{{ $contract_request->customerCompany->company_legal_name }} /
                                    {{ $contract_request->customerCompany->company_commercial_name }}</small>
                                <br>
                                @endif
                                <small>{{ $contract_request->client_identifier }}</small><br>
                                <span class="badge"
                                    style="color: #ffffff; background-color: {{ $contract_request->contractRequestStatus->color }}">
                                    {{ $contract_request->contractRequestStatus->name }}
                                </span>
                            </h2>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-xl-3 m-auto text-center">
                            <div id="image-comp">
                                <div class="hidden-button">
                                <img class="w-100" style="max-height: 200px; max-width: 130px;" src="{{asset("storage/" . $contract_request->customerCompany->logo)}}" alt="Logo del Cliente">
                                    <a style="position: absolute; left: 50%; bottom: 50%; transform: translate(-50%,50%)" href="#" data-toggle="modal" data-target="#companyLogoModal" class="btn btn-sm btn-primary text-white" type="button"><span><i class="fas fa-edit"></i></span> Editar Logo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-reset w-100">
                <div class="col 12 col-md-12">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="request-tab" data-toggle="tab" href="#request"
                                    role="tab" aria-controls="request" aria-selected="true">Información y Contacto</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="document-tab" data-toggle="tab" href="#document"
                                    role="tab" aria-controls="home" aria-selected="false">Documentos de Solicitud</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="status-tab" data-toggle="tab" href="#status" role="tab"
                                    aria-controls="status" aria-selected="false">Seguimiento de Solicitud</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">
                    @include('xisfopay::layouts.contract_requests.admin.contacts')
                </div>
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                    @include('xisfopay::layouts.contract_requests.admin.documents')
                </div>
                <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                    <div class="row">
                        @include('generals::layouts.admin.commentaries.commentaries', ['datas' =>
                        $contract_request->contractRequestCommentaries])
                        @include('generals::layouts.admin.statusesLog', ['datas' =>
                        $contract_request->contractRequestStatusesLogs])
                    </div>
                </div>
            </div>
            @include('generals::layouts.admin.buttons.back_to_index')
        </div>
    </div>
    @include('xisfopay::layouts.contract_requests.admin.edit_company_logo', ['data' => $contract_request->customerCompany])
    @include('xisfopay::layouts.contract_requests.admin.edit_contract_request', ['data' => $contract_request])
    @include('xisfopay::layouts.contract_requests.admin.edit_customer', ['data' => $contract_request->customer])
    @include('xisfopay::layouts.contract_requests.admin.edit_customer_password_modal', ['data' => $contract_request->customer])
    @include('xisfopay::layouts.contract_requests.admin.add_comment_modal', ['id' => $contract_request->id])
    @include('xisfopay::layouts.contract_requests.admin.add_contract_modal')
    @include('xisfopay::layouts.contract_requests.admin.add_master_account_modal')
    @include('xisfopay::layouts.contract_requests.add_bank_account_modal')
    @include('xisfopay::layouts.contract_requests.admin.add_customer_identity_modal')
    @include('xisfopay::layouts.contract_requests.admin.print_contracts_modal', ['data' => $contract_request])
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
@section('scripts')
<script>
    function check_pass() {
        if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
            document.getElementById('submit').disabled = false;
        } else {
            document.getElementById('submit').disabled = true;
        }
    }
</script>
@include('generals::layouts.cities-selectorJS')
@endsection
