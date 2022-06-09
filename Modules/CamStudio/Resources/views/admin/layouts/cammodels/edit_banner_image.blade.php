<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Cambiar Banner</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label" for="cover">Banner</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-image"></i></span>
                            </div>
                            <input type="file" name="cover_page" id="cover_page" value="{{$cammodel->cover_page}}"
                                class="form-control" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                        <button type="button" class="btn btn-link btn-sm ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
