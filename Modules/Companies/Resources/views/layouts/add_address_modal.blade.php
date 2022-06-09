<!-- The Address Modal -->
<!-- Modal -->
<div class="modal fade" id="addressmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar dirección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.employee-addresses.store') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body py-0">
                    @csrf
                    <input name="employee_id" id="employee_id" type="hidden" validation-pattern="text"
                        value="{{ $employee->id }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="housing_id">Tipo Vivienda</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-house-user"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <select name="housing_id" id="housing_id" class="form-control" enabled>
                                        @if(!empty($housings))
                                        @foreach($housings as $housing)
                                        <option value="{{ $housing->id }}">{{ $housing->housing }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="time_living">Antiguedad</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="text" name="time_living" validation-pattern="number" id="time_living"
                                        placeholder="Antiguedad en meses" class="form-control"
                                        value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="address">Dirección</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-map-marker-alt"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" name="address" validation-pattern="text" id="address"
                                        placeholder="Dirección Residencia" class="form-control"
                                        value="{{ old('address') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="stratum_id">Estrato Socioeconómico</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-home"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <select name="stratum_id" id="stratum_id" class="form-control" enabled>
                                        @if(!empty($stratums))
                                        @foreach($stratums as $stratum)
                                        <option value="{{ $stratum->id }}">
                                            {{ $stratum->description }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="city_id">Ciudad</label>
                                <div class="input-group input-group-merge">
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
