<div class="modal fade" id="modal{{$cammodelWorkReport->cammodel->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Registro de venta para {{ $cammodelWorkReport->cammodel->nickname }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.store') }}" method="post" class="form"
                onsubmit="disable_button('create_button_{{ $cammodelWorkReport->cammodel->id }}')">
                @csrf
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="disconnection_time">Hora de Desconexión</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" class="form-control" name="disconnection_time"
                                        value="{{ old('disconnection_time') }}" required>
                                </div>
                            </div>
                        </div>
                        @foreach ($cammodelWorkReport->cammodel->cammodelStreamAccountsWithoutSkype as $streamAccount)
                        <div class="col-12" @if ($streamAccount->streaming->is_automated == 1)
                            style="display: none;"
                        @endif>
                            <div class="form-group">
                                <label class="form-control-label" for="streaming_{{$streamAccount->streaming->id}}">
                                    @if ($streamAccount->streaming->usd_token_rate == 1)
                                    Dolares -
                                    @else
                                    Tokens -
                                    @endif
                                    {{ $streamAccount->streaming->streaming }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                    </div>
                                    <input type="number" step="any" class="form-control" name="streamings[{{$streamAccount->id}}]"
                                        value="0" required>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <input type="hidden" name="cammodel_work_report_id" value="{{ $cammodelWorkReport->id }}"
                            required>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm"
                        id="create_button_{{ $cammodelWorkReport->cammodel->id }}">Crear</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
