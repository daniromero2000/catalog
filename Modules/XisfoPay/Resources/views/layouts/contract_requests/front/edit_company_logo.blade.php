<div class="modal fade" id="companyLogoModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Logo De Empresa <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.update_logo', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_company_logo_update">
                @csrf
                <div class="modal-body py-0">
                    <div id="size_overflow_logo" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span
                            style="color: #f5365c;">
                            <i class="fas fa-exclamation-circle"></i>
                        </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_logo"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="logo">Logo Empresa</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-image"></i></span>
                                    </div>
                                    <input type="file" name="logo" id="file_logo" placeholder="Logo" class="form-control"
                                        value="{!! $data->logo ?: old('logo')  !!}" accept="image/*"
                                        onchange="AcceptableFileUpload('form_company_logo_update', '0', 'logo')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_logo">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
