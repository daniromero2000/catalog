<div class="modal fade" id="bankTransfermodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Transferencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.register.token.advance.transfer') }}" method="post" class="form">
                <div class="modal-body py-0">
                    @csrf
                    <input name="payment_request_id" id="payment_request_id" type="hidden"
                        value="{{$payment_request_advance->paymentRequest->id}}">
                    <input name="payment_request_advance_id" id="payment_request_advance_id" type="hidden"
                        value="{{$payment_request_advance->id}}">
                    <input name="value" id="value" type="hidden" value="{{$payment_request_advance->value}}">
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
