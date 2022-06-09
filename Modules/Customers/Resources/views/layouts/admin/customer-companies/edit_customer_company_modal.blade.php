<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post"
                class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="customer_id">Cliente</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-user"></i></span>
                                    </div>
                                    <select name="customer_id" id="customer_id"
                                        class="form-control">
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @if($customer->id ==
                                            $data->customer_id)
                                            selected="selected" @endif >{{ $customer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="constitution_type">Tipo de
                                    Constitución</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-balance-scale"></i></span>
                                    </div>
                                    <select name="constitution_type" id="constitution_type"
                                        class="form-control">
                                        <option selected="selected" @if("Natural" ==$data->constitution_type)
                                            selected="selected" @endif value="Natural">
                                            Natural</option>
                                        <option @if("Jurídica"==$data->constitution_type)
                                            selected="selected" @endif value="Jurídica">Jurídica
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="company_legal_name">Nombre
                                    Legal Empresa</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="company_legal_name"
                                        id="company_legal_name"
                                        validation-pattern="company_legal_name"
                                        placeholder="Nombre Legal Empresa" class="form-control"
                                        value="{{ $data->company_legal_name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="company_commercial_name">Nombre Comercial Empresa</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="company_commercial_name"
                                        id="company_commercial_name"
                                        validation-pattern="company_commercial_name"
                                        placeholder="Nombre Comercial Empresa" class="form-control"
                                        value="{{ $data->company_commercial_name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="company_address">Dirección</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" name="company_address" id="company_address"
                                        validation-pattern="company_address" placeholder="Dirección"
                                        class="form-control" value="{{ $data->company_address }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="neighborhood">Barrio</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" name="neighborhood" id="neighborhood"
                                        validation-pattern="neighborhood" placeholder="Barrio"
                                        class="form-control" value="{{ $data->neighborhood }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="company_phone">Teléfono</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="company_phone" id="company_phone"
                                        validation-pattern="company_phone" placeholder="Teléfono"
                                        class="form-control" value="{{ $data->company_phone }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label"
                                    for="country_id_representative">País
                                </label>
                                <select id="country_id_4_{{$data->id}}" required
                                    class="form-control"
                                    onchange="changeCountry('4',{{$data->id}})">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="provinces_4_{{$data->id}}" class="form-group">
                                <label class="laber-form-card form-control-label"
                                    for="province_id">Departamento <span
                                        class="text-danger">*</span></label>
                                <select id="province_id_4_{{$data->id}}"
                                    onchange="getProvince('4',{{$data->id}})" required
                                    class="form-control">
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
                        <input type="hidden" value="{{$data->city->id}}" name="city_id"
                            id="city_target_4_{{$data->id}}">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" id="cities_4_{{$data->id}}" enabled
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="is_aprobed">Aprobación</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-check-double"></i></span>
                                    </div>
                                    <select name="is_aprobed" id="is_aprobed" class="form-control">
                                        <option @if(0==$data->is_aprobed)
                                            selected="selected" @endif value="0">
                                            No Aprobado</option>
                                        <option @if(1==$data->is_aprobed)
                                            selected="selected" @endif value="1">Aprobado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="is_active">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-check"></i></span>
                                    </div>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option @if(0==$data->is_active)
                                            selected="selected" @endif value="0">
                                            Inactivo</option>
                                        <option @if(1==$data->is_active)
                                            selected="selected" @endif value="1">Activo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm"
                        data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>