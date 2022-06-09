<div class="modal fade mt-5" id="editCustomerModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #154293">
                     <i class="fas fa-user-edit"></i> Editar datos de cliente (representante legal)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.customers.updateForBlade', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombres</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" validation-pattern="name"
                                        placeholder="Nombres" class="form-control"
                                        value="{!! $data->name ?: old('name')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="birthday">Fecha de nacimiento</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="date" name="birthday" id="birthday" validation-pattern="birthday"
                                        placeholder="Fecha de nacimiento" class="form-control"
                                        value="{!! $data->birthday ?: old('birthday')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Apellidos</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                        placeholder="Apellidos" class="form-control"
                                        value="{!! $data->last_name ?: old('last_name')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="country_id_representative">País </label>
                                <select id="country_id_1_" required
                                    class="custom-select input-form-register" onchange="changeCountry('1')">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="provinces_1_" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                                        class="text-danger">*</span></label>
                                <select id="province_id_1_" onchange="getProvince('1')" required
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
                        <input type="hidden" value="" name="city_id" id="city_target_1_">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select input-form-register" name="city_id" id="cities_1_" enabled
                                    required>
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
                                <label class="laber-form-card form-control-label" for="country_id_representative">País de nacimiento</label>
                                <select id="country_id_birth_" required
                                    class="custom-select input-form-register" onchange="changeCountry('birth')">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="provinces_birth_" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">Departamento de nacimiento<span
                                        class="text-danger">*</span></label>
                                <select id="province_id_birth_" onchange="getProvince('birth')" required
                                    class="custom-select input-form-register">
                                    <option value selected disabled>--Select an option--</option>
                                    @foreach ($provinces as $province)
                                    @if($province->id == $data->birthCity->province_id)
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad de nacimiento <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select input-form-register" name="birth_place_id" id="cities_birth_" enabled
                                    required>
                                    <option value selected disabled>--Select an option--</option>
                                    @foreach ($cities as $city)
                                    @if($city->id == $data->birth_place_id)
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
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
