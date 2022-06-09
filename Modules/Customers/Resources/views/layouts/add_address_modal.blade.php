<!-- The Address Modal -->
<div id="addressmodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa dirección</h4>
      </div>
      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-addresses.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" validation-pattern="text" value="{{ $customer->id }}">
              <div id="housing_id" class="form-group">
                <label for="housing_id">Tipo Vivienda <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
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
              <div class="form-group">
                <label for="time_living">Antiguedad <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="time_living" validation-pattern="number" id="time_living"
                    placeholder="Antiguedad en meses" class="form-control" value="{{ old('time_living') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="customer_address">Dirección <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="customer_address" validation-pattern="text" id="customer_address"
                    placeholder="Dirección Residencia" class="form-control" value="{{ old('customer_address') }}"
                    required>
                </div>
              </div>
              <div id="customer_stratum_id" class="form-group">
                <label for="stratum_id">Estrato Socioeconómico <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check" aria-hidden="true"></i>
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
              <div id="cities" class="form-group">
                <label for="city_id">Ciudad <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
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
