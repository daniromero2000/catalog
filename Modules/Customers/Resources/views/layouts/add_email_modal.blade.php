<!-- The email Modal -->
<div id="emailmodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Email</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-emails.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-at"></i>
                  </div>
                  <input type="text" name="email" validation-pattern="email" id="email" placeholder="Email"
                    class="form-control" value="{{ old('email') }}" required>
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
