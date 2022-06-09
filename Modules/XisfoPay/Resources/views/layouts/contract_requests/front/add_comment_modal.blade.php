<div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Comentario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.contract-request-commentaries.store') }}" method="post" class="form"
                enctype="multipart/form-data" onsubmit="disable_button('create_button_add_comment_modal')">
                <div class="modal-body py-0">
                    @csrf
                    <input name="contract_request_id" id="contract_request_id" type="hidden" value="{{ $id }}">
                    <div class="form-group">
                        <label class="form-control-label" for="commentary">Comentario<span
                            class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-comment-alt"></i></span>
                            </div>
                            <input type="text" name="commentary" validation-pattern="text" id="commentary"
                                placeholder="Comentario" class="form-control" value="{{ old('commentary') }}" required
                                autofocus>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-3 text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_add_comment_modal">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
