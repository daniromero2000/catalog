<div class="container">
    <div class="col pl-0 mb-3">
        <h4 class="text-center p-3 mb-2 mt-2 title-items-info">DATOS DEL CLIENTE</h4>
    </div>
    <div class="row row-reset">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="name">Nombres <span
                        class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input onchange="name_change()" type="text" name="name" id="name" validation-pattern="name"
                        class="form-control input-form-register" value="{{ old('name') }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="last_name">Apellidos <span
                        class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input onchange="name_change()" type="text" name="last_name" id="last_name"
                        class="form-control input-form-register" value="{{ old('last_name') }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="name">Fecha de nacimiento
                    <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input type="date" name="birthday" id="birthday" validation-pattern="date"
                        class="form-control input-form-register" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-reset">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="email">Correo <span
                        class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input type="text" name="email" id="email" validation-pattern="email"
                        class="form-control input-form-register" value="{{ old('email') }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="phone">
                    Teléfono
                    <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input type="text" name="phone" id="phone" class="form-control input-form-register"
                        value="{{ old('phone') }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label laber-form-card" for="customer_address">
                    Dirección
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-merge">
                    <input type="text" name="customer_address" id="customer_address"
                        class="form-control input-form-register" value="{{ old('customer_address') }}" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-reset">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="country_id_customer">País </label>
                <select name="country_id" id="country_id_customer_{{$id}}" required
                    class="custom-select input-form-register" onchange="changeCountry('customer', '{{$id}}')">
                    @foreach($countries as $country)
                    <option @if('1'==$country->id) selected="selected" @endif
                        value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div id="provinces_customer_{{$id}}" class="form-group">
                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                        class="text-danger">*</span></label>
                <select id="province_id_customer_{{$id}}" onchange="getProvince('customer', '{{$id}}')" required
                    class="custom-select input-form-register">
                    <option value selected disabled>--Select an option--</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div id="cities_customer_{{$id}}" class="form-group">
                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                        class="text-danger">*</span></label>
                <select class="custom-select input-form-register" name="city_id" id="city_id{{$id}}" enabled required>
                    <option value selected disabled>--Select an option--</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col pl-0 mb-3">
        <h4 class="text-center p-3 mb-2 mt-3 title-items-info">IDENTIFICACIÓN DEL CLIENTE</h4>
    </div>
    <div class="row row-reset">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="identity_type_id">
                    Tipo de identificación
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group mb-3">
                    <select class="custom-select input-form-register" name="identity_type_id" id="identity_type_id"
                        enabled required>
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
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="identity_number">
                    Número de identificación
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-merge">
                    <input type="text" name="identity_number" validation-pattern="IdentificationNumber"
                        id="identity_number" class="form-control input-form-register"
                        value="{{ old('identity_number') }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="expedition_date">Fecha de expedición
                    <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input type="date" name="expedition_date" min="1900-01-01"
                        max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" id="expedition_date" placeholder="Fecha"
                        class="form-control input-form-register" value="{{ old('expedition_date') }}" required>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col pl-0 mb-3">
        <h4 class="text-center p-3 mb-2 mt-3 title-items-info">DATOS DE LA EMPRESA</h4>
    </div>
    <div class="row row-reset">
        <input type="hidden" name="constitution_type" id="constitution_type_{{$id}}" value="Natural" required>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="company_commercial_name">Nombre
                    comercial <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input type="text" name="company_commercial_name" validation-pattern="name"
                        id="company_commercial_name" class="form-control input-form-register"
                        value="{{ old('company_commercial_name') }}" required>
                </div>
            </div>
        </div>
        <div class="in_legal_name col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="display: none;">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="company_legal_name">Nombre legal
                    <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input type="text" name="company_legal_name" validation-pattern="name" id="company_legal_name"
                        placeholder="Legal" class="form-control input-form-register"
                        value="{{ old('company_legal_name') }}" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
                <label class="laber-form-card form-control-label" for="country_id_representative">País </label>
                <select name="country_id" id="country_id_representative_{{$id}}" required
                    class="custom-select input-form-register" onchange="changeCountry('representative', '{{$id}}')">
                    @foreach($countries as $country)
                    <option @if('1'==$country->id) selected="selected" @endif
                        value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div id="provinces_representative_{{$id}}" class="form-group">
                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                        class="text-danger">*</span></label>
                <select id="province_id_representative_" onchange="getProvince('representative', '{{$id}}')" required
                    class="custom-select input-form-register">
                    <option value selected disabled>--Select an option--</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div id="cities_representative_{{$id}}" class="form-group">
                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                        class="text-danger">*</span></label>
                <select class="custom-select input-form-register" name="company_city_id" id="company_city_id" enabled
                    required>
                    <option value selected disabled>--Select an option--</option>
                </select>
            </div>
        </div>
        
    </div>
</div>
<div class="container mt-4">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="data_politics" name="data_politics" required>
        <label class="laber-form-card form-check-label" for="data_politics">
            Acepto los <a href="{{ route('data-policy') }}"> <span>términos y condiciones.</span>
            </a>
        </label>
    </div>
    <div class="row row-reset w-100">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="captcha">
                <div class="g-recaptcha" data-sitekey="6Lc65tEaAAAAAGJX8z2Myq2Ga8jBjyHAmvauhLD0"
                    data-callback="removeFakeCaptcha"></div>
                <input type="checkbox" class="captcha-fake-field" tabindex="-1" required>
            </div>
        </div>
    </div>
</div>
