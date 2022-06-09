<div class="modal fade" id="professionmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar profesion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.employee-professions.store') }}" method="post" class="form"
      enctype="multipart/form-data">
        <div class="modal-body py-0">
          @csrf
          <input name="employee_id" id="employee_id" type="hidden" value="{{ $employee->id }}">
          <div class="form-group">
            <label class="form-control-label" for="professions_list_id">Tipo</label>
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-stethoscope"></i></span>
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
        <div class="w-100 p-3 text-right">
          <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>