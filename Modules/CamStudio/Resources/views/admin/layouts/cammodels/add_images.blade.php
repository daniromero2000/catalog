@include('generals::layouts.admin.tooltips.tooltipCSS')
<div class="modal fade" id="modal-img" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Tus imagenes</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_inputs">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="modal-body">
                    <div id="size_overflow_" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                <i class="fas fa-exclamation-circle"></i>
                            </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="cover">Imagenes</label>
                                <a class="text-center info-tooltip" data-toggle="tooltip" data-original-title="Puedes usar (cmd o ctrl) para seleccionar
                                                multiples
                                                imagenes">
                                    ! </a>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                    </div>
                                    <input type="file" name="image[]" id="image" 
                                    class="form-control" multiple accept="image/*"
                                    onchange="AcceptableFileUpload('form_inputs', '0', '')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Actualizar</button>
                        <button type="button" class="btn btn-link btn-sm ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('generals::layouts.admin.files.size_calculatorJS')
