<div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar comentario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.lead-commentaries.store') }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body py-0">
                    @csrf
                    <input name="lead_id" id="lead_id" type="hidden" value="{{ $lead->id }}">
                    <div class="form-group">
                        <label class="form-control-label" for="commentary">Comentario</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="commentary" validation-pattern="text" id="commentary"
                                placeholder="Comentario" class="form-control" value="{{ old('commentary') }}" required
                                autofocus>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-3 text-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
