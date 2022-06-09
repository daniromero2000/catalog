<!-- The EmergencyContact Modal -->
<!-- Modal -->
<div class="modal fade" id="emergencycontactmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar contacto de emergencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.employee-emergency-contacts.store') }}" method="post" enctype="multipart/form-data">
        <div class="modal-body py-0">
          @csrf
          <input name="employee_id" id="employee_id" type="hidden" validation-pattern="text"
            value="{{ $employee->id }}">
            <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-control-label" for="name">Nombre</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-font"></i></span>
                  </div>
                  <input type="text" name="name" validation-pattern="text" id="name"
                    placeholder="Nombre" class="form-control" value="{{ old('name') }}" required>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-control-label" for="phone">Teléfono</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i></span>
                  </div>
                  <input type="text" name="phone" validation-pattern="text" id="phone"
                    placeholder="Teléfono" class="form-control" value="{{ old('phone') }}"
                    required>
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