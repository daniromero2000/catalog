<!-- The eps Modal -->
<div id="epsmodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Eps</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-epss.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div id="cities" class="form-group">
                <label for="eps_id">Eps <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-stethoscope"></i>
                  </div>
                  <select name="eps_id" id="eps_id" class="form-control" enabled>
                    @foreach($epss as $eps)
                    <option value="{{ $eps->id }}">{{ $eps->eps }}</option>
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
