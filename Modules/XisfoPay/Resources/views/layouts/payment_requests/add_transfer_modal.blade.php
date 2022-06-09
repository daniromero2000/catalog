<div class="modal fade" id="bankTransfermodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Avance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment-bank-transfers.store') }}" method="post" class="form">
                <div class="modal-body py-0" onsubmit="disable_button('create_button_add_transfer_modal')">
                    @csrf
                    <input name="payment_request_id" id="payment_request_id" type="hidden"
                        value="{{$payment_request->id}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="value">Valor en pesos (COP) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="decimal" name="value" id="value" validation-pattern="decimal"
                                        placeholder="Valor" class="form-control" value="{{ old('value') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" id="create_button_add_transfer_modal">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
