<!-- The Identity Modal -->
<div id="identitymodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Documento de Identidad</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-identities.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div id="identity_type_id" class="form-group">
                <label for="identity_type_id">Tipo Vivienda <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
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
              <div class="form-group">
                <label for="identity_number">Número de Documento <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="identity_number" validation-pattern="IdentificationNumber"
                    id="identity_number" placeholder="Número de Documento" class="form-control"
                    value="{{ old('identity_number') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="expedition_date">Fecha de Expedición <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <input type="date" name="expedition_date" min="1900-01-01"
                    max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" id="expedition_date" placeholder="Dirección Residencia"
                    class="form-control" value="{{ old('expedition_date') }}" required>
                </div>
              </div>
              <div id="cities" class="form-group">
                <label for="city_id">Ciudad de Expedición <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </div>
                  <select name="city_id" id="city_id" class="form-control" enabled>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
