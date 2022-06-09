<div class="modal fade" id="addCustomerIdentityModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Identidad dfgsdf</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.customer-identities.store') }}" method="POST" class="form"
                enctype="multipart/form-data" onsubmit="disable_button('create_button_add_customer_identity_modal')">
                <div class="modal-body py-0">
                    @csrf
                    <input id="customer_id" name="customer_id" value="{{ $contract_request->customer->id }}" hidden>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="identity_type_id">Tipo de Documento <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <select name="identity_type_id" id="identity_type_id" class="form-control" enabled
                                        required>
                                        <option disabled selected value> -- select an option -- </option>
                                        @foreach($identity_types as $identity_type)
                                        <option value="{{ $identity_type->id }}">{{ $identity_type->identity_type }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="identity_number">Número <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="identity_number" id="identity_number"
                                        placeholder="Número" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="expedition_date">Fecha de Expedición <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="expedition_date" id="expedition_date"
                                        placeholder="Fecha" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="country_id_representative">País
                                </label>
                                <select id="country_id_4_add_identity" required class="form-control"
                                    onchange="changeCountry('4','add_identity')">
                                    @foreach($countries as $country)
                                    <option @if('1'==$country->id) selected="selected" @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="provinces_4_add_identity" class="form-group">
                                <label class="laber-form-card form-control-label" for="province_id">Departamento <span
                                        class="text-danger">*</span></label>
                                <select id="province_id_4_add_identity" onchange="getProvince('4','add_identity')" required
                                    class="form-control">
                                    <option value selected disabled>--Select an option--</option>
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->province }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="" name="city_id" id="city_target_4_add_identity">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="laber-form-card form-control-label" for="city">Ciudad <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="cities_4_add_identity" enabled
                                    required onchange="cityValuer(4,'add_identity')">
                                    <option value selected disabled>--Select an option--</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="city_id">Ciudad <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                    </div>
                                    <select name="city_id" id="city_id" class="form-control" enabled required>
                                        <option disabled selected value> -- select an option -- </option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_add_customer_identity_modal">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
