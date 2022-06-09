<div class="modal fade" id="modal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar <b>{{ $data->name }}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.roles.update', $data->id) }}" method="post" class="form">
                @method('PUT')
                @csrf
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="display_name{{ $data->id }}">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    </div>
                                    <input type="text" name="display_name" id="display_name{{ $data->id }}"
                                        placeholder="Nombre" validation-pattern="name" class="form-control" required
                                        value="{{ old('display_name') ?: $data->display_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="address{{ $data->id }}">Descripción</label>
                                <div class="input-group input-group-merge">
                                    <textarea name="description" id="description{{ $data->id }}" class="form-control"
                                        validation-pattern="text" required
                                        placeholder="Descripción"> {!!  old('description') ?: $data->description !!}</textarea>

                                </div>
                            </div>
                        </div>
                        <h4 class="mb-3"> Permisos</h4>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
