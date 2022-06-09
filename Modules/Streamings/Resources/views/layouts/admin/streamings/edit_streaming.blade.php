<!-- Modal -->
<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-12" id="size_overflow_{{$data->id}}" style="display: none">
                            <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span></h3>
                            <p>
                                El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                            </p>
                            <p>Los archivos que has seleccionado pesan <span id="total_size_{{$data->id}}"></span>MB</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="streaming">Streaming</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="streaming" id="streaming" validation-pattern="streaming"
                                        class="form-control" value="{{ $data->streaming }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="value">URL</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="text" name="value" id="value" validation-pattern="value"
                                        placeholder="Valor" class="form-control" value="{{ $data->url }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="usd_commission">Comisión Dolares</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="text" name="usd_commission" id="usd_commission"
                                        validation-pattern="value" placeholder="Valor" class="form-control"
                                        value="{{ $data->usd_commission }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="is_active">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option @if(0==$data->is_active)
                                            selected="selected" @endif
                                            value="0">Inactivo
                                        </option>
                                        <option @if(1==$data->is_active)
                                            selected="selected" @endif
                                            value="1">Activo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon">Logo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <input type="file" name="icon" id="icon_{{$data->id}}" validation-pattern="icon"
                                        class="form-control"
                                        onchange="AcceptableFileUpload('form_inputs', '0', '{{$data->id}}', 'icon_{{$data->id}}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm"
                        id="create_button_{{$data->id}}">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
