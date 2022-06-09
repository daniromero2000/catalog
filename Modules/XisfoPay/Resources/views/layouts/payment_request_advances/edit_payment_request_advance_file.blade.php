@include('generals::layouts.admin.tooltips.tooltipCSS')
<div class="modal fade" id="filemodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Avances De Solicitud De Pago<b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment-request-advances.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_{{$data->id}}">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div id="size_overflow_" style="display: none">
                        <h5>TAMAÑO DE ARCHIVO EXCEDIDO<span
                            style="color: #f5365c;">
                            <i class="fas fa-exclamation-circle"></i>
                        </span></h5>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="payment_type">Comprobantes</label>
                                <a class="text-center info-tooltip" data-toggle="tooltip" data-original-title="Puedes usar (cmd o ctrl) para seleccionar
                                    multiples
                                    imagenes">
                                ! </a>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="image[]" id="image" class="form-control" multiple
                                        accept="image/*, .pdf" onchange="AcceptableFileUpload('form_{{$data->id}}', '0', '')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('generals::layouts.admin.files.size_calculatorJS')
