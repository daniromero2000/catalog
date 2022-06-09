<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            @if (!$data->is_aprobed)
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Solicitud De Pago<b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment-requests.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon">Cantidad</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="usd_amount" name="usd_amount"
                                        value="{{ $data->usd_amount }}">
                                    <div class="input-group-append">
                                        @if ($data->payment_type == "2")
                                        <span class="input-group-text">Tokens</span>
                                        @else
                                        <span class="input-group-text">USD</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Giro del Pago<span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-funnel-dollar"></i></span>
                                    </div>
                                    <select class="form-control" name="chase_transfer_id" id="chase_transfer_id">
                                        <option selected value> -- select an option -- </option>
                                        @foreach ($chase_transfers as $chase_transfer)
                                        <option value="{{ $chase_transfer->id }}">
                                            Giro {{$chase_transfer->id }} -
                                            ${{  number_format($chase_transfer->transfer_amount) }} {{  $chase_transfer->created_at->format('M d, Y') }}
                                            / ${{  number_format($chase_transfer->chaseTransferTrm->trm, 2) }} - {{ $chase_transfer->chaseTransferTrm->bank->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="color">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    <select name="payment_request_status_id" id="payment_request_status_id"
                                        class="form-control select2">
                                        <option value=""></option>
                                        @foreach($payment_request_statuses as
                                        $payment_request_status)
                                        @if ($payment_request_status->id == 5)
                                        @if (!$data->is_aprobed && $data->hasUnAprobedAdvances->isEmpty())
                                        <option @if($payment_request_status->id ==
                                            $data->payment_request_status_id)
                                            selected="selected" @endif
                                            value="{{ $payment_request_status->id }}">{{ $payment_request_status->name }}
                                        </option>
                                        @endif
                                        @else
                                        <option @if($payment_request_status->id ==
                                            $data->payment_request_status_id)
                                            selected="selected" @endif
                                            value="{{ $payment_request_status->id }}">{{ $payment_request_status->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            @else
            <div class="modal-header">
                <h5 class="modal-title">Ya fue Aprobado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
