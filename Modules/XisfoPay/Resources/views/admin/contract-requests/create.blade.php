@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form" onsubmit="disable_button('create_button_')">
            @csrf
            <div class="card-body">
                <div class="col pl-0 mb-3">
                    <h2>Diligencia los siguientes datos del cliente para iniciar el proceso de Negociación</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col pl-0 mb-3">
                            <h2 class="text-center p-3 mb-2 bg-secondary">Datos del Representante Legal</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer_group_id">Tipo de Cliente <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <select name="customer_group_id" id="customer_group_id" class="form-control"
                                            enabled required>
                                            <option disabled selected value> -- select an option -- </option>
                                            @if(!empty($customer_groups))
                                            @foreach($customer_groups as $customer_group)
                                            <option value="{{ $customer_group->id }}">
                                                {{ $customer_group->name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nombres <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="name" id="name" validation-pattern="name"
                                            placeholder="Nombres" class="form-control" value="{{ old('name') }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="last_name">Apellidos <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="last_name" id="last_name" placeholder="Apellidos"
                                            class="form-control" value="{{ old('last_name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Fecha de Nacimiento <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                        </div>
                                        <input type="date" name="birthday" id="birthday" validation-pattern="date"
                                            placeholder="Fecha Nacimiento" class="form-control"
                                            value="{{ old('birthday') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="genre_id">Género <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                        </div>
                                        <select name="genre_id" id="genre_id" class="form-control" enabled required>
                                            <option disabled selected value> -- select an option -- </option>
                                            @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}">{{ $genre->genre }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="text" name="email" id="email" validation-pattern="email"
                                            placeholder="Email" class="form-control" value="{{ old('email') }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="phone">Teléfono <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="phone" id="phone" placeholder="Teléfono"
                                            class="form-control" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer_address">Dirección <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input type="text" name="customer_address" id="customer_address"
                                            placeholder="Dirección" class="form-control"
                                            value="{{ old('customer_address') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer_address">Barrio <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input type="text" name="neighborhood" id="neighborhood" placeholder="Barrio"
                                            class="form-control" value="{{ old('neighborhood') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col pl-0 mb-3">
                            <h2 class="text-center p-3 mb-2 bg-secondary">Datos de Identificación</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="identity_type_id">Tipo de Identificación <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <select name="identity_type_id" id="identity_type_id" class="form-control"
                                            enabled required>
                                            <option disabled selected value> -- select an option -- </option>
                                            @if(!empty($identity_types))
                                            @foreach($identity_types as $identity_type)
                                            <option value="{{ $identity_type->id }}">
                                                {{ $identity_type->identity_type }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="identity_number">Numero <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="identity_number"
                                            validation-pattern="IdentificationNumber" id="identity_number"
                                            placeholder="Número de Documento" class="form-control"
                                            value="{{ old('identity_number') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="expedition_date">Fecha de Expedición <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                        </div>
                                        <input type="date" name="expedition_date" min="1900-01-01"
                                            max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" id="expedition_date"
                                            placeholder="Fecha" class="form-control"
                                            value="{{ old('expedition_date') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col pl-0 mb-3">
                            <h2 class="text-center p-3 mb-2 bg-secondary">Datos de Empresa</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="constitution_type">Tipo de Constitución <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-balance-scale"></i></span>
                                        </div>
                                        <select name="constitution_type" id="constitution_type"
                                            class="form-control select2" onchange="myfunction(this)" required>
                                            <option disabled selected value> -- select an option -- </option>
                                            <option value="Natural">Natural</option>
                                            <option value="Jurídica">Jurídica</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4" id="is_tokens" style="display: none;">
                                <div class="form-group">
                                    <label class="form-control-label" for="contract_request_type">¿Es venta tokens? <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-balance-scale"></i></span>
                                        </div>
                                        <select name="is_tokens" id="contract_request_type"
                                            class="form-control select2" required>
                                            <option disabled selected value> -- select an option -- </option>
                                            <option value="1">Sí, es venta Tokens</option>
                                            <option value="0">No, es Factoring</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="company_commercial_name">Nombre
                                        Comercial <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="company_commercial_name" validation-pattern="name"
                                            id="company_commercial_name" placeholder="Comercial" class="form-control"
                                            value="{{ old('company_commercial_name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="company_legal_name">Nombre Legal <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="company_legal_name" validation-pattern="name"
                                            id="company_legal_name" placeholder="Legal" class="form-control"
                                            value="{{ old('company_legal_name') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="country_id">País </label>
                                    <select name="country_id" id="country_id" required class="form-control select2">
                                        @foreach($countries as $country)
                                        <option @if('1'==$country->id) selected="selected" @endif
                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="provinces" class="form-group">
                                    <label class="form-control-label" for="province_id">Departamento <span class="text-danger">*</span></label>
                                    <select  id="province_id" onchange="getProvince()" required class="form-control select2">
                                        <option value selected disabled>--Select an option--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="cities" class="form-group">
                                    <label class="form-control-label" for="city">Ciudad <span class="text-danger">*</span></label>
                                    <select name="city_id" id="city_id" required class="form-control select2">
                                        <option value selected disabled>--Select an option--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')

<script>
    $(document).ready(function () {
        getCity($('#country_id').val());

        $('#country_id').change(function () {
            var city = $('#country_id').val();
            getCity(city);
        });

        function getCity(city) {
            $.get('/admin/api/getCountry/' + city + '/province/', function (data) {
                if (data) {
                    let html = '<label class="form-control-label" for="province_id">Departamento <span class="text-danger">*</span></label>';
                    html +=
                        '<select  id="province_id" onchange="getProvince()" required class="form-control select2"> <option value selected disabled>--Select an option--</option>';
                    $(data).each(function (idx, v) {
                        html += '<option value="' + v.id + '">' + v.province + '</option>';
                    });
                    html += '</select>';

                    $('#provinces').html(html).show();
                }
            });
        }
        $('#province_id').change(function () {
            getProvince(province);
        });
    });

    function getProvince() {
        var province = $('#province_id').val();
        $.get('/admin/api/getProvince/' + province + '/city/', function (data) {
            if (data) {
                let html = '<label class="form-control-label" for="city">Ciudad <span class="text-danger">*</span></label>';
                html +=
                    '<select name="city_id" id="city_id" required class="form-control select2"> <option value selected disabled>--Select an option--</option>';
                $(data).each(function (idx, v) {
                    html += '<option value="' + v.id + '">' + v.city + '</option>';
                });
                html += '</select>';

                $('#cities').html(html).show();
            }
        });
    }
</script>
@endsection
@include('xisfopay::admin.contract-requests.createJS')
