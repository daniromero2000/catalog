<div class="modal fade" id="addressmodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar residencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.customer-addresses.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="customer_address">Dirección</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                                    </div>
                                    <input type="text" name="customer_address" id="customer_address"
                                        validation-pattern="name" placeholder="Dirección" class="form-control"
                                        value="{!! $data->customer_address ?: old('customer_address')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="neighborhood">Barrio</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                                    </div>
                                    <input type="text" name="neighborhood" id="neighborhood" validation-pattern="name"
                                        placeholder="Barrio" class="form-control"
                                        value="{!! $data->neighborhood ?: old('neighborhood')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="country_id_representative">País
                                </label>
                                <select id="country_id_2_" required class="custom-select input-form-register"
                                    onchange="changeCountry('2')">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="provinces_2_" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                                        class="text-danger">*</span></label>
                                <select id="province_id_2_" onchange="getProvince('2')" required
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
                        <input type="hidden" value="{{$data->city->id}}" name="city_id" id="city_target_2_">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select input-form-register" id="cities_2_" enabled
                                    required onchange="cityValuer()">
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
