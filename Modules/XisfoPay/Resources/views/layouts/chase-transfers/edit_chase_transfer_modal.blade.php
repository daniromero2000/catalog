<div class="modal fade" id="modal{{$chaseTransfer->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row row-reset w-100">
                    <div class="col-12 text-center">
                        <h5 class="modal-title">Actualizar <b>{{$chaseTransfer->name}}</b></h5>
                    </div>
                </div>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $chaseTransfer->id) }}" method="post"  class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        @if ($chaseTransfer->is_approved != 1)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="transfer_amount">Monto</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="transfer_amount" name="transfer_amount"
                                        value="{{ $chaseTransfer->transfer_amount }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">COP</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($chaseTransfer->chaseTransferAmounts->isNotEmpty())    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="is_approved">Activo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-check"></i></span>
                                    </div>
                                    <select name="is_approved" id="is_approved" class="form-control">
                                        @if( 0 == $chaseTransfer->is_approved)
                                        <option selected="selected" value="0">No aprobado</option>
                                        <option value="1">Aprobado</option>
                                        @elseif( 1 == $chaseTransfer->is_approved)
                                        <option selected="selected" value="1">Aprobado</option>
                                        <option value="0">No aprobado</option>
                                        @else
                                        <option value="0">No aprobado</option>
                                        <option value="1">  Aprobado</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        @else
                        <div class="row row-reset w-100">
                            <div class="col-12 text-center">
                                <img style="width: 50px;" src="{{ asset('img/xisfopay/payment-aprobbed.png')}}" alt="Prestamo aprobado">
                                <br>
                                <span>El giro ya fue aprobado, no puede ser modificado.</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    @if ($chaseTransfer->is_approved != 1)
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