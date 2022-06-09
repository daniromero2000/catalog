@include('generals::layouts.admin.tooltips.tooltipCSS')
<div class="modal fade" id="advancemodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Avance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment-request-advances.store') }}" method="post" class="form"
                enctype="multipart/form-data" id="form_inputs" onsubmit="disable_button('create_button_')">
                <div class="modal-body py-0">
                    <div id="size_overflow_" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                <i class="fas fa-exclamation-circle"></i>
                            </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_"></span>MB</p>
                    </div>
                    @csrf
                    <input name="payment_request_status_id" id="payment_request_status_id" type="hidden" value="1">
                    <input name="payment_request_id" id="payment_request_id" type="hidden"
                        value="{{$payment_request->id}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="value">Valor en pesos (COP) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="decimal" name="value" id="value" validation-pattern="decimal"
                                        placeholder="Valor" class="form-control" value="{{ old('value') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="payment_type">Comprobantes <span
                                        class="text-danger">*</span></label>
                                <a class="text-center info-tooltip" data-toggle="tooltip" data-original-title="Puedes usar (cmd o ctrl) para seleccionar
                                        multiples
                                        imagenes">
                                    ! </a>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="image[]" id="image" class="form-control" multiple
                                        accept="image/*, .pdf"
                                        onchange="AcceptableFileUpload('form_inputs', '0', '')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
