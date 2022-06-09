<div class="modal fade" id="contractmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.contracts.store') }}" method="post" class="form"
                enctype="multipart/form-data" onsubmit="disable_button('generate_contract_button')">
                <div class="modal-body py-0">
                    @csrf
                    <input name="contract_status_id" id="contract_status_id" type="hidden" value="1">
                    <span class="text-sm">¿Estás seguro que deseas generar un contrato a este cliente?</span><br>
                <input name="contract_request_id" id="contract_request_id" type="hidden" value="{{$contract_request->id}}">
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="generate_contract_button">Generar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('generals::layouts.admin.buttons.disable_button')
