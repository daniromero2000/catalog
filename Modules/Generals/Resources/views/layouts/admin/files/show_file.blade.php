<div class="modal fade" id="fileModal{{$file}}{{$data->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Documento</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="w-100">
                    <object data="{{ asset("storage/$file") }}" type="application/pdf"
                        width="400" height="500">
                        <embed src="{{ asset("storage/$file") }}" width="400"
                            height="500" type="application/pdf" class="img-fluid lazy" frameborder="0">
                    </object>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
