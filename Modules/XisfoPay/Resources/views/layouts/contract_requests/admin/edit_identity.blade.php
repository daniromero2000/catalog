<div class="modal fade" id="identitymodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Identidad <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.customer-identities.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_{{$data->id}}">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div id="size_overflow_{{$data->id}}" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span
                            style="color: #f5365c;">
                            <i class="fas fa-exclamation-circle"></i>
                        </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_{{$data->id}}"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="city_id">Tipo de Identidad</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                    </div>
                                    <select name="identity_type_id" id="city_id" class="form-control">
                                        @foreach($identity_types as $identity_type)
                                        @if($identity_type->id == $data->identityType->id)
                                        <option selected="selected" value="{{ $identity_type->id }}">
                                            {{ $identity_type->identity_type }}</option>
                                        @else
                                        <option value="{{ $identity_type->id }}">{{ $identity_type->identity_type }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="identity_number">Número</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="identity_number" id="identity_number"
                                        validation-pattern="number" placeholder="Número" class="form-control"
                                        value="{!! $data->identity_number ?: old('identity_number')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="expedition_date">Fecha Expedición</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-week"></i></span>
                                    </div>
                                    <input type="date" name="expedition_date" id="expedition_date"
                                        validation-pattern="date" placeholder="Número" class="form-control"
                                        value="{!! $data->expedition_date ?: old('expedition_date')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="country_id_representative">País
                                </label>
                                <select id="country_id_4_{{$data->id}}" required class="custom-select input-form-register"
                                    onchange="changeCountry('4',{{$data->id}})">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="provinces_4_{{$data->id}}" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                                        class="text-danger">*</span></label>
                                <select id="province_id_4_{{$data->id}}" onchange="getProvince('4',{{$data->id}})" required
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
                        <input type="hidden" value="{{$data->city->id}}" name="city_id" id="city_target_4_{{$data->id}}">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select input-form-register" id="cities_4_{{$data->id}}" enabled
                                    required onchange="cityValuer(4,{{$data->id}})">
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
                                <label class="form-control-label" for="file">Archivo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="file" id="file_{{$data->id}}_1" 
                                        placeholder="Archivo" class="form-control"
                                        value="{!! $data->file ?: old('file')  !!}" accept="image/*, .pdf"
                                        onchange="AcceptableFileUpload('form_{{$data->id}}', '0', '{{$data->id}}', 'file_{{$data->id}}_1')">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="icon{{ $data->id }}">Activo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    @include('generals::layouts.admin.is_active_layout', ['status'
                                    => $data->is_active])
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="icon{{ $data->id }}">Aprobado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check-double"></i></span>
                                    </div>
                                    @include('generals::layouts.admin.is_aprobed_layout', ['status'
                                    => $data->is_aprobed])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_{{$data->id}}">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
