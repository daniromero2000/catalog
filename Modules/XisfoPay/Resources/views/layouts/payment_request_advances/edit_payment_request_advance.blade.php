<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row row-reset w-100">
                    <div class="col-12 text-center">
                        <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.payment-request-advances.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        @if ($data->is_aprobed != 1)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon">Cantidad</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="value" name="value"
                                        value="{{ $data->value }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">COP</span>
                                    </div>
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
                                        <option @if($payment_request_status->id ==
                                            $data->payment_request_status_id)
                                            selected="selected" @endif
                                            value="{{ $payment_request_status->id }}">{{ $payment_request_status->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row row-reset w-100">
                            <div class="col-12 text-center">
                                <img style="width: 50px;" src="{{ asset('img/xisfopay/payment-aprobbed.png')}}" alt="Prestamo aprobado">
                                <br>
                                <span>El prestamo fue aprobado, no puede ser modificado.</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    @if ($data->payment_request_status_id != 5)
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    @else
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
