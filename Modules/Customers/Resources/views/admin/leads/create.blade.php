@extends('generals::layouts.admin.app')
@section('module-name')
    Crear lead |
@endsection
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.leads.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <input type="text" value="1" name="data_politics" id="data_politics" hidden>
                <input hidden type="text" value="3" name="lead_status_id" id="lead_status_id">
                <div class="col pl-0 mb-3">
                    <h2>Crear lead</h2>
                </div>
                <div class="row w-100 p-5">
                    <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">NOMBRE(S) 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre(s)"
                                        class="form-control" value="{{ old('name') }}" required onkeypress="return onlyletters(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="form-control-label" for="last_name">APELLIDO(S)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                        placeholder="Apellido(s)" class="form-control" value="{{ old('last_name') }}" required onkeypress="return onlyletters(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="form-control-label" for="last_name">CORREO ELECTRÓNICO 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" name="email" id="email" validation-pattern="email"
                                        placeholder="Correo electrónico" class="form-control" value="Sin email">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="form-control-label" for="last_name">TELÉFONO / WHATSAPP 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" id="phone" validation-pattern="phone"
                                        placeholder="Teléfono celular" class="form-control" value="{{ old('phone ') }}" required onkeypress="return valideKey(event);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="country_id_representative">PAÍS 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                    </div>
                                    <select id="country_id_2_" required class="custom-select input-form-register"
                                        onchange="changeCountry('2')">
                                        @foreach($countries as $country)
                                        <option @if('1'==$country->id) selected="selected" @endif
                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div id="provinces_2_" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">DEPARTAMENTO / ESTADO 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <select id="province_id_2_" onchange="getProvince('2')" required
                                        class="custom-select input-form-register">
                                        <option value selected disabled>-- Seleccione una opción --</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-reset w-100">
                        <input type="hidden" value="" name="city_id" id="city_target_2_">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">CIUDAD <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    </div>
                                    <select class="custom-select input-form-register" id="cities_2_" enabled required
                                        onchange="cityValuer()">
                                        <option value selected disabled>-- seleccione una opción --</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="form-control-label" for="customer_channel_id">CANAL DE CONTACTO
                                    <i class="fas fa-check-circle i-item-color"></i>
                                    <span class="text-danger">*</span> 
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group">
                                        <select name="customer_channel_id" id="customer_channel_id" class="form-control select" required>
                                            <option disabled selected value> -- seleccione una opción -- </option>
                                            @foreach($customer_channels as $customer_channels)
                                            <option value="{{ $customer_channels->id }}">{{ $customer_channels->channel }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div id="service_id" class="form-group">
                                <label class="form-control-label" for="lead_status_id">SERVICIO 
                                    <i class="fas fa-concierge-bell i-item-color"></i>
                                    <span class="text-danger">*</span> 
                                </label>
                                <div class="input-group">
                                    <div class="input-group input-group-merge">
                                        <select name="service_id" id="service_id" class="form-control select" enabled required>
                                            <option disabled selected value> -- selecciona una opción -- </option>
                                            @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->service }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div id="service_id" class="form-group">
                                <label class="form-control-label" for="lead_reason_id">MOTIVO DE INTENCIÓN 
                                    <i class="fas fa-concierge-bell i-item-color"></i>
                                    <span class="text-danger">*</span> 
                                </label>
                                <div class="input-group">
                                    <div class="input-group input-group-merge">
                                        <select name="lead_reason_id" id="lead_reason_id" class="form-control select" enabled required>
                                            <option disabled selected value> -- selecciona una opción -- </option>
                                            @foreach($reasons as $reason)
                                            <option value="{{ $reason->id }}">{{ $reason->reason }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.leads.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
@include('generals::layouts.cities-selectorJS')
@include('generals::layouts.validate-formsJS')
@endsection