<div class="modal fade" id="modal-bankImage{{$customer_account->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Documento De Cuenta Bancaria: <span style="color: rgb(0, 0, 155)">{{ $customer_account->bank->name }} 
                    {{ $customer_account->account_type }} / {{ $customer_account->account_number }} </span></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if (!empty($customer_account->account_certificate))
            @include('generals::layouts.admin.files.show_pdf_or_image', ['data'=>
            $customer_account->account_certificate])
            @else
            <div class="modal-body">
                <span>No hay un documento de cuenta bancaria.</span>
            </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
