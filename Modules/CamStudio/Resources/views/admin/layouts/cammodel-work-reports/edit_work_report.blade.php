<!-- Modal -->
<div class="modal fade" id="modal{{$cammodelWorkReport->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Falta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $cammodelWorkReport->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="cammodel_id">Modelo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                                    </div>
                                    <select class="form-control" name="cammodel_id" id="cammodel_id" disabled>
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($cammodels as $cammodel)
                                            <option value="{{ $cammodel->id }}" 
                                                    @if ($cammodel->id == $cammodelWorkReport->cammodel_id)
                                                    selected
                                                    @endif>{{ $cammodel->nickname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="room_id">Room</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                                    </div>
                                    <select class="form-control" name="room_id" id="room_id">
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}"
                                                @if ($room->id == $cammodelWorkReport->room_id)
                                                selected
                                                @endif>{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="shift_id">Turno</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <select class="form-control" name="shift_id" id="shift_id">
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($shifts as $shift)
                                            <option value="{{ $shift->id }}"
                                                @if ($shift->id == $cammodelWorkReport->shift_id)
                                                selected
                                                @endif>{{ $shift->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if ($cammodelWorkReport->disconnection_time == null)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="entry_time">Hora de Entrada</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" class="form-control" name="entry_time" 
                                        value="{{ $cammodelWorkReport->entry_time }}">
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="connection_time">Hora de Conexión</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" class="form-control" name="connection_time" 
                                        value="{{ $cammodelWorkReport->connection_time }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="disconnection_time">Hora de Desconexión</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" class="form-control" name="disconnection_time" 
                                        value="{{ $cammodelWorkReport->disconnection_time }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $cammodelWorkReport->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
