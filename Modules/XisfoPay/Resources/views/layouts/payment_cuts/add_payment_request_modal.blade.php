<div class="modal fade" id="addPaymentRequestModal{{$paymentCut->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Solicitud de Pago al Corte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0">
                <form action="{{ route('admin.addPaymentRequestToCut') }}" method="post" class="form"
                    onsubmit="disable_button('add_payment_request_button')">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="payment_cut_id" value="{{ $paymentCut->id }}">
                    <div class="form-group">
                        <label class="form-control-label" for="payment_request_id">Solicitud de pago</label>
                        <select class="form-control select" name="payment_request_id" id="payment_request_id">
                            <option value selected disabled>--select an option--</option>
                            @foreach ($pendingPayments as $paymentRequest)
                                <option value="{{ $paymentRequest->id }}">
                                    {{ $paymentRequest->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name }}
                                    {{ $paymentRequest->contractRequestStreamAccount->nickname }}
                                    {{$paymentRequest->contractRequestStreamAccount->streaming->streaming }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="add_payment_request_button">Agregar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
