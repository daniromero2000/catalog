<!-- The phone Modal -->
<div id="phonemodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Teléfono</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-phones.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div class="form-group">
                <label for="phone_type" class="">Tipo <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <select name="phone_type" id="phone_type" class="form-control select2">
                    <option value="Fijo">Fijo</option>
                    <option value="Móvil">Móvil</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="phone">Teléfono <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="phone" id="phone" validation-pattern="telephone" placeholder="Teléfono"
                    class="form-control" value="{{ old('phone') }}" required>
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
