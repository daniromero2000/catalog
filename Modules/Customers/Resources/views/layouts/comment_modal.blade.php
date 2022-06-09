<!-- The Comment Modal -->
<div id="commentmodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa el comentario</h4>
      </div>
      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-commentaries.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
              @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div class="form-group">
                <label for="commentary">Comentario <span class="text-danger">*</span></label>
                <input type="text" name="commentary" validation-pattern="text" id="commentary" placeholder="Comentario"
                  class="form-control" value="{{ old('commentary') }}" required autofocus>
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