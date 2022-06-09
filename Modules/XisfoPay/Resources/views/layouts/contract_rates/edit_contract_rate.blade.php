<!-- Modal -->
<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Tarifa De Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="percentage">Porcentaje</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input type="text" name="percentage" id="percentage" validation-pattern="percentage"
                                        placeholder="Porcentaje" class="form-control" value="{{ $data->percentage }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="type">Tipo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                    <select name="type" id="type" class="form-control">
                                        <option @if(0==$data->type)
                                            selected="selected" @endif
                                            value="0">Normal
                                        </option>
                                        <option @if(1==$data->type)
                                            selected="selected" @endif
                                            value="1">Especial
                                        </option>
                                        <option @if(2==$data->type)
                                            selected="selected" @endif
                                            value="2">Tokens
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="value">Valor</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="value" id="value" validation-pattern="value"
                                        placeholder="Valor" class="form-control" value="{{ $data->value }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="is_aprobed">Aprobación</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                    </div>
                                    <select name="is_aprobed" id="is_aprobed" class="form-control">
                                        <option @if(0==$data->is_aprobed)
                                            selected="selected" @endif
                                            value="0">No Aprobado
                                        </option>
                                        <option @if(1==$data->is_aprobed)
                                            selected="selected" @endif
                                            value="1">Aprobado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
