<div class="modal fade" id="epsmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Eps</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.employee-epss.store') }}" method="post" class="form"
          enctype="multipart/form-data">
        <div class="modal-body py-0">
          @csrf
          <input name="employee_id" id="employee_id" type="hidden" value="{{ $employee->id }}">
          <div class="form-group">
            <label class="form-control-label" for="eps_id">Eps</label>
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-stethoscope"></i></span>
              </div>
              <select name="eps_id" id="eps_id" class="form-control" enabled>
                  @foreach($epss as $eps)
                  <option value="{{ $eps->id }}">{{ $eps->eps }}</option>
                  @endforeach
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