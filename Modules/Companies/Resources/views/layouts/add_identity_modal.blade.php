<div class="modal fade" id="identitymodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Documento de Identidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.employee-identities.store') }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body py-0">
                    @csrf
                    <input name="employee_id" id="employee_id" type="hidden" value="{{ $employee->id }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="identity_type_id">Tipo de Identidad</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-id-card"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <select name="identity_type_id" id="identity_type_id" class="form-control" enabled>
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="identity_number">Número de Documento</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" name="identity_number" validation-pattern="IdentificationNumber"
                                        id="identity_number" placeholder="Número de Documento" class="form-control"
                                        value="{{ old('identity_number') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="expedition_date">Fecha de Expedición</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar-week"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="date" name="expedition_date" min="1900-01-01"
                                        max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" id="expedition_date"
                                        placeholder="Dirección Residencia" class="form-control"
                                        value="{{ old('expedition_date') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="city_id">Ciudad de Expedición</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-map-marker-alt"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <select name="city_id" id="city_id" class="form-control" enabled>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
