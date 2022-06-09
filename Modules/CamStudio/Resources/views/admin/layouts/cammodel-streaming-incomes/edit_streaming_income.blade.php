<!-- Modal -->
<div class="modal fade" id="modal{{$cammodelWorkReport->cammodelStreamingIncomes[0]->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Ingreso De Plataforma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update-package', $cammodelWorkReport->cammodelStreamingIncomes[0]->id) }}" method="post"
                class="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-0">
                    @if ($cammodelWorkReport->cammodelStreamingIncomes[0]->user_approves != null)
                    <div class="row">
                        <div class="col-12 mb-3">
                            <span class="text-warning">El registro de ventas ya fue aprobado</span>
                        </div>
                    </div>
                    @endif
                    @foreach($cammodelWorkReport->cammodelStreamingIncomes as $data)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="tokens">
                                    @if ($data->cammodelStreamAccount->streaming->usd_token_rate == 1)
                                    Dolares -
                                    @else
                                    Tokens -
                                    @endif
                                    {{ $data->cammodelStreamAccount->streaming->streaming }}
                                </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                    </div>
                                    @if ($data->cammodelStreamAccount->streaming->is_automated == 0)
                                        @if ($data->cammodelStreamAccount->streaming->usd_token_rate == 1)
                                        <input type="number" step="any" class="form-control"
                                            name="tokens[{{ $data->cammodel_stream_account_id }}]"
                                            value="{{ $data->tokens }}">
                                        @else
                                        <input type="number" class="form-control"
                                            name="tokens[{{ $data->cammodel_stream_account_id }}]"
                                            value="{{ $data->tokens * 1 }}">
                                        @endif
                                    @else
                                        @if ($data->cammodelStreamAccount->streaming->usd_token_rate == 1)
                                        <input type="number" readonly="readonly" step="any" class="form-control"
                                            name="tokens[{{ $data->cammodel_stream_account_id }}]"
                                            value="{{ $data->tokens }}">
                                        @else
                                        <input type="number" readonly="readonly" class="form-control"
                                            name="tokens[{{ $data->cammodel_stream_account_id }}]"
                                            value="{{ $data->tokens * 1 }}">
                                        @endif
                                    @endif
                                </div>
                                <input type="hidden" class="form-control"
                                    name="streamings[{{ $data->cammodel_stream_account_id }}]"
                                    value="{{ $data->cammodel_stream_account_id }}" required>
                                <input type="hidden" class="form-control"
                                    name="incomes[{{ $data->cammodel_stream_account_id }}]"
                                    value="{{ $data->id }}" required>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if ($cammodelWorkReport->cammodelStreamingIncomes[0]->user_approves == null)
                    <div class="card-footer text-right">
                        <input type="hidden" name="cammodel_work_report_id"
                            value="{{ $cammodelWorkReport->cammodelStreamingIncomes[0]->cammodel_work_report_id }}">
                        <button type="submit" class="btn btn-primary btn-sm">Aprobar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
