<!-- The professiion Modal -->
<div id="professionmodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa profesion</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-professions.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div class="form-group">
                <label for="professions_list_id" class="">Tipo <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-briefcase"></i>
                  </div>
                  <select name="professions_list_id" id="professions_list_id" class="form-control" enabled>
                    @if(!empty($professions_lists))
                    @foreach($professions_lists as $professions_list)
                    <option value="{{ $professions_list->id }}">
                      {{ $professions_list->profession }}</option>
                    @endforeach
                    @endif
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
