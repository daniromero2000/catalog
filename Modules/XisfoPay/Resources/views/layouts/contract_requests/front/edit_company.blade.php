<div class="modal fade" id="companymodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Información De Empresa <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('account.customer-companies.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_company_update">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div id="size_overflow_" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span
                            style="color: #f5365c;">
                            <i class="fas fa-exclamation-circle"></i>
                        </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="constitution_type">Tipo de Constitución</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                    </div>
                                    <select name="constitution_type" id="constitution_type" class="form-control">
                                        @if( 'Natural' == $data->constitution_type)
                                        <option selected="selected" value="Natural">Natural</option>
                                        <option value="Jurídica">Jurídica</option>
                                        @elseif( 'Jurídica' == $data->constitution_type)
                                        <option selected="selected" value="Jurídica">Jurídica</option>
                                        <option value="Natural">Natural</option>
                                        @else
                                        <option value="Natural">Natural</option>
                                        <option value="Jurídica">Jurídica</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="company_legal_name">Nombre Legal</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="company_legal_name" id="company_legal_name"
                                        validation-pattern="name" placeholder="Número" class="form-control"
                                        value="{!! $data->company_legal_name ?: old('company_legal_name')  !!}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="company_commercial_name">Nombre Comercial</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="company_commercial_name" id="company_commercial_name"
                                        validation-pattern="name" placeholder="Número" class="form-control"
                                        value="{!! $data->company_commercial_name ?: old('company_commercial_name')  !!}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="logo">Logo Empresa</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-image"></i></span>
                                    </div>
                                    <input type="file" name="logo" id="file_logo" placeholder="Logo" class="form-control"
                                        value="{!! $data->logo ?: old('logo')  !!}" accept="image/*"
                                        onchange="AcceptableFileUpload('form_company_update', '0', '', 0, '1')">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="company_address">Dirección</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                                    </div>
                                    <input type="text" name="company_address" id="company_address"
                                        validation-pattern="name" placeholder="Número" class="form-control"
                                        value="{!! $data->company_address ?: old('company_address')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="neighborhood">Barrio</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                                    </div>
                                    <input type="text" name="neighborhood" id="neighborhood" validation-pattern="name"
                                        placeholder="Número" class="form-control"
                                        value="{!! $data->neighborhood ?: old('neighborhood')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="company_phone">Teléfono</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="company_phone" id="company_phone" validation-pattern="name"
                                        placeholder="Número" class="form-control"
                                        value="{!! $data->company_phone ?: old('company_phone')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="company_phone">NIT/RUT</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="company_id_number" id="company_id_number"
                                        validation-pattern="name" placeholder="NIT/RUT" class="form-control"
                                        value="{!! $data->company_id_number ?: old('company_id_number')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="country_id_representative">País
                                </label>
                                <select id="country_id_3_" required class="custom-select input-form-register"
                                    onchange="changeCountry('3')">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="provinces_3_" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                                        class="text-danger">*</span></label>
                                <select id="province_id_3_" onchange="getProvince('3')" required
                                    class="custom-select input-form-register">
                                    <option value selected disabled>--Select an option--</option>
                                    @foreach ($provinces as $province)
                                    @if($province->id == $data->city->province_id)
                                    <option selected="selected" value="{{ $province->id }}">
                                        {{ $province->province }}</option>
                                    @else
                                    <option value="{{ $province->id }}">{{ $province->province }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="{{$data->city->id}}" name="city_id" id="city_target_3_">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select input-form-register" id="cities_3_" enabled
                                    required onchange="cityValuer(3)">
                                    <option value selected disabled>--Select an option--</option>
                                    @foreach ($cities as $city)
                                    @if($city->id == $data->city->id)
                                    <option selected="selected" value="{{ $city->id }}">
                                        {{ $city->city }}</option>
                                    @else
                                    <option value="{{ $city->id }}">{{ $city->city }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="company_phone">Número de Sedes</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input type="number" name="subsidiaries" id="subsidiaries" validation-pattern="name"
                                        placeholder="NIT/RUT" class="form-control"
                                        value="{!! $data->subsidiaries ?: old('subsidiaries')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="file">Camara De Comercio
                                    <small>Archivo</small></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="file" id="file_commerce" placeholder="Archivo" class="form-control"
                                        value="{!! $data->file ?: old('file')  !!}" accept="image/*, .pdf"
                                        onchange="AcceptableFileUpload('form_company_update', '0', '', 0, '1')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
