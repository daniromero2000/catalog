@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
Anticipos
@endsection
@section('breadcum-item')
Solicitar Anticipo
@endsection
@include('generals::layouts.admin.tooltips.tooltipCSS')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @include('generals::layouts.errors-and-messages')
            <div class="card">
                <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form" enctype="multipart/form-data"
                    id="form_inputs" onsubmit="disable_button('create_button_')">
                    <div class="card-body">
                        @csrf
                        <div class="col pl-0 mb-3">
                            <h2>Solicitar Anticipo</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="form-control-label" for="contract_request_stream_account_id">Plataforma<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <select name="contract_request_stream_account_id"
                                            id="contract_request_stream_account_id" class="form-control select" enabled required
                                            onchange="payment_type_finder()">
                                            <option disabled selected value> -- Select an option -- </option>
                                            @foreach($stream_accounts as $stream_account)
                                            <option value="{{ $stream_account->id }}">
                                                {{ $stream_account->nickname }} {{ $stream_account->streaming->streaming }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @foreach ($stream_accounts as $stream_account)
                                    <input type="hidden"
                                        value="{{$stream_account->contractRequest->contract->contractRenewals->where('is_active', 1)->first()->contractRate->type}}"
                                        id="key_{{$stream_account->id}}">
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="payment_type" value="0">
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
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

                            <div class="col-sm-4">
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
                                        <input type="file" name="image[]" id="image" class="form-control" multiple required
                                            accept="image/*, .pdf" onchange="AcceptableFileUpload('form_inputs', '1', '')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
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
                                        <input type="file" name="image[]" id="image" class="form-control" multiple required
                                            accept="image/*, .pdf" onchange="AcceptableFileUpload('form_inputs', '1', '')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button id="create_button_" type="submit" class="btn btn-primary btn-sm">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('generals::layouts.admin.files.size_calculatorJS')
<script type="text/javascript" src="{{asset('js/utilities.js')}}"></script>
@endsection
