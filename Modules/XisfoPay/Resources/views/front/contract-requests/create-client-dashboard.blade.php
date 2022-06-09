@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fas fa-file-contract"></i> Solicitudes de contrato
@endsection
@section('breadcum-item')
Solicitudes de contrato
@endsection
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @include('generals::layouts.errors-and-messages')
            <div class="card">
                <form action="{{ route('account.store-new-contract-request') }}" method="post" class="form" id="form_inputs"
                    onsubmit="disable_button('create_button_')">
                    @csrf
                    <div class="card-body">
                        <div class="col pl-0 mb-3">
                            <h4 class="text-center mb-2 title-items-info">DATOS DE LA EMPRESA</h4>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="laber-form-card form-control-label" for="constitution_type">
                                        Tipo de constitución
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="constitution_type" id="constitution_type"
                                            enabled required>
                                            <option value selected disabled>--Select an option--</option>
                                            <option value="Natural">Natural</option>
                                            <option value="Jurídica">Jurídica</option>
                                            <option value="Tokens">Venta Tokens</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="laber-form-card form-control-label" for="identity_number">
                                        RUT
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="identity_number"
                                            validation-pattern="IdentificationNumber" id="identity_number"
                                            class="form-control input-form-register"
                                            value="{{ old('identity_number') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="laber-form-card form-control-label" for="expedition_date">Fecha de
                                        expedición
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" name="expedition_date" min="1900-01-01"
                                            max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" id="expedition_date"
                                            placeholder="Fecha" class="form-control input-form-register"
                                            value="{{ old('expedition_date') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="laber-form-card form-control-label"
                                        for="company_commercial_name">Nombre
                                        comercial <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-font"></i></span>
                                        </div>
                                        <input type="text" name="company_commercial_name" validation-pattern="name"
                                            id="company_commercial_name" class="form-control input-form-register"
                                            value="{{ old('company_commercial_name') }}" placeholder="Comercial" required>
                                    </div>
                                </div>
                            </div>
                            <div class="in_legal_name col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="laber-form-card form-control-label" for="company_legal_name">Nombre
                                        legal
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-font"></i></span>
                                        </div>
                                        <input type="text" name="company_legal_name" validation-pattern="name"
                                            id="company_legal_name" placeholder="Legal"
                                            class="form-control input-form-register"
                                            value="{{ old('company_legal_name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="laber-form-card form-control-label"
                                        for="country_id_representative">País <span class="text-danger">*</span></label>
                                    <select name="country_id" id="country_id_representative_{{$id}}" required
                                        class="form-control" onchange="changeCountry('representative', '{{$id}}')">
                                        @foreach($countries as $country)
                                        <option @if('1'==$country->id) selected="selected" @endif
                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div id="provinces_representative_{{$id}}" class="form-group">
                                    <label class="laber-form-card form-control-label" for="province_id">Departamento
                                        <span class="text-danger">*</span></label>
                                    <select id="province_id_representative_"
                                        onchange="getProvince('representative', '{{$id}}')" required
                                        class="form-control">
                                        <option value selected disabled>--Select an option--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div id="cities_representative_{{$id}}" class="form-group">
                                    <label class="laber-form-card form-control-label" for="city">Ciudad <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="company_city_id" id="company_city_id" enabled
                                        required>
                                        <option value selected disabled>--Select an option--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function change_constitution(type) {
        document.getElementById("constitution_type").value = type;
        name_change();
    }

    function name_change() {
        if (document.getElementById("constitution_type").value == 'Natural') {
            document.getElementById("company_legal_name").value = document.getElementById("name").value + " " + document
                .getElementById("last_name").value;
            var elements = document.getElementsByClassName("in_legal_name");
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = 'none';
            }
            // document.getElementById("natural_button").style.backgroundColor = "#154293";
            // document.getElementById("natural_button").style.color = "#FFFFFF";
            // document.getElementById("legal_button").style.backgroundColor = "";
        } else {
            document.getElementById("company_legal_name").value = '';
            var elements = document.getElementsByClassName("in_legal_name");
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = 'inline';
            }
            // document.getElementById("legal_button").style.backgroundColor = "#154293";
            // document.getElementById("natural_button").style.backgroundColor = "";
        }
    }

</script>
@include('xisfopay::front.layouts.cities-selectorJS')
@endsection
