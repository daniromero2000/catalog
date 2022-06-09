<div class="modal fade" id="modal-companyImage{{$customer_company->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Documento De Cámara De Comercio</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if (!empty($customer_company->file))
            <div class="modal-body d-flex flex-column align-items-stretch" style="height: 600px">
                    <object data="{{ asset("storage/$customer_company->file") }}" type="application/pdf"
                        style="height: 100%">
                        <embed src="{{ asset("storage/$customer_company->file") }}" type="application/pdf" class="img-fluid lazy" frameborder="0">
                    </object>
            </div>
            @else
            <div class="modal-body">
                <span>No hay un documento de Cámara De Comercio</span>
            </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
