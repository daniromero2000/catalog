<div class="modal fade" id="modal{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Registro en {{$room->name}} ({{ $room->subsidiary->name }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.store') }}" method="post" class="form"
                onsubmit="disable_button('create_button_{{ $room->id }}')">
                @csrf
                <div class="modal-body py-0">
                    @if (!empty($room->photo))
                    @include('camstudio::admin.layouts.show_pdf_or_image', ['data'=>
                    $room->photo])
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="shift_id">Turno</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <select class="form-control" name="shift_id" id="shift_id" required>
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="cammodel_id">Modelo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                                    </div>
                                    <select class="form-control" name="cammodel_id" id="cammodel_id" required>
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($cammodels as $cammodel)
                                        <option value="{{ $cammodel->id }}">{{ $cammodel->nickname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="entry_time">Hora de Ingreso</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" class="form-control" name="entry_time"
                                        value="{{ old('entry_time') }}" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="room_id" value="{{ $room->id }}" required>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm"
                        id="create_button_{{ $room->id }}">Crear</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
