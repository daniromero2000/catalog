@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.tooltips.tooltipCSS')
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
                            <li class="breadcrumb-item active">Habilitar Pago</li>
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
        <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form" enctype="multipart/form-data"
            id="form_inputs" onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Habilitar Pago</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="contract_request_stream_account_id">Plataforma <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select name="contract_request_stream_account_id"
                                    id="contract_request_stream_account_id" class="form-control select" enabled required
                                    onchange="payment_type_finder(1)">
                                    <option disabled selected value> -- Select an option -- </option>
                                    @foreach($stream_accounts as $stream_account)
                                    <option value="{{ $stream_account->id }}">
                                        {{ $stream_account->contractRequest->customerCompany->company_legal_name }}
                                        {{ $stream_account->nickname }} {{ $stream_account->streaming->streaming }}
                                    </option>
                                    @endforeach
                                    @foreach ($stream_accounts as $key => $stream_account)
                                    <input type="hidden"
                                        value="{{$stream_account->contractRequest->contract->contractRenewals->where('is_active', 1)->first()->contractRate->type}}"
                                        id="key_{{$stream_account->id}}">
                                    <input type="hidden" id="target_{{$stream_account->id}}" value="{{$key}}">
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="payment_type">Tipo de Pago <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money-bill"></i></span>
                                </div>
                                <select name="payment_type" id="payment_type" class="form-control select2"
                                    onchange="loan_modal()" required>
                                    <option disabled selected value id="option_default"> -- Select an option --
                                    </option>
                                    <option value="0" id="option_0">Adelanto Chaturbate - USD</option>
                                    <option value="1" id="option_1">Pago Total - USD</option>
                                    <option value="2" id="option_2">Compra Tokens - TKS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="usd_amount" id="input_quantity">Cantidad<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="decimal" name="usd_amount" id="usd_amount" validation-pattern="decimal"
                                    placeholder="Ingrese la cantidad" class="form-control"
                                    value="{{ old('usd_amount') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="payment_type">Cuenta Bancaria <span
                                    class="text-danger">*</span>
                                <small>Cuenta a la que desea que se realice el pago</small> </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-credit-card"></i></span>
                                </div>
                                <select class="form-control" name="customer_bank_account_id"
                                    id="customer_bank_account_id" required>
                                    <option value selected disabled>--Select an option--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="payment_type">Comprobante<span
                                    class="text-danger">*</span> <small>Adjuntar Comprobante del Streaming</small>
                            </label>
                            <a class="text-center info-tooltip" data-toggle="tooltip" data-original-title="Puedes usar (cmd o ctrl) para seleccionar
                                    multiples
                                    imagenes">
                                ! </a>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-file-alt"></i></span>
                                </div>
                                <input type="file" name="image[]" id="image" class="form-control" multiple
                                    accept="image/*, .pdf" onchange="AcceptableFileUpload('form_inputs', '1', '')">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="payment_type">Factura <span
                                    class="text-danger">*</span>
                                <small>Adjuntar Factura del Streaming</small> </label>
                            <a class="text-center info-tooltip" data-toggle="tooltip" data-original-title="Puedes usar (cmd o ctrl) para seleccionar
                                    multiples
                                    imagenes">
                                ! </a>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-file-alt"></i></span>
                                </div>
                                <input type="file" name="image[]" id="image" class="form-control" multiple
                                    accept="image/*, .pdf" onchange="AcceptableFileUpload('form_inputs', '1', '')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="loan" name="loan">
            <div class="card-footer text-right">
                <button id="create_button_" type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>
    <div class="modal fade" id="loan_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header m-auto">
                </div>
                <div class="modal-body text-center" style="padding:0px !important;">
                    <p>
                        ¿Desea un prestamo?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" onclick="activate_loan(1)"
                        data-dismiss="modal">Sí</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="activate_loan(0)"
                        data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var bank_accounts = JSON.parse('<?php echo json_encode($stream_accounts)?>');
</script>
@include('generals::layouts.admin.files.size_calculatorJS')
@include('generals::layouts.utilities')
@endsection
