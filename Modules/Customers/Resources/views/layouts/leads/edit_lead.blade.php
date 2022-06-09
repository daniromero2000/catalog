<div class="modal fade mt-5" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Lead: <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.leads.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row row-reset w-100 p-2">
                        <div class="row row-reset w-100">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nombre</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="name" id="name" validation-pattern="name"
                                            placeholder="Nombre" class="form-control"
                                            value="{!! $data->name ?: old('name')  !!}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="last_name">Apellido</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                            placeholder="Apellido" class="form-control"
                                            value="{!! $data->last_name ?: old('last_name')  !!}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-reset w-100">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="text" name="email" id="email" validation-pattern="email"
                                            placeholder="Email" class="form-control"
                                            value="{!! $data->email ?: old('email')  !!}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Teléfono</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="phone" id="phone" validation-pattern="phone"
                                            placeholder="Teléfono" class="form-control"
                                            value="{!! $data->phone ?: old('phone')  !!}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-reset w-100">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                        </div>
                        <div class="row row-reset w-100">
                            <input type="hidden" value="{{$data->city->id}}" name="city_id" id="city_target_4_{{$data->id}}">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="lead_status_id" class="form-group">
                                    <label class="form-control-label" for="lead_status_id">Estado</label>
                                    <div class="input-group">
                                        <select name="lead_status_id" id="lead_status_id" class="form-control">
                                            @foreach($lead_statuses as $lead_status)
                                            @if($lead_status->id == $data->leadStatus->id)
                                            <option selected="selected" value="{{ $lead_status->id }}">
                                                {{ $lead_status->name }}</option>
                                            @else
                                            <option value="{{ $lead_status->id }}">{{ $lead_status->name }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
