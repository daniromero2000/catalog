<!-- Modal -->
<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Falta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_inputs_{{$data->id}}">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Falta</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" 
                                        class="form-control" value="{{ $data->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="subsidiary_id">Sede</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-laptop-house"></i></span>
                                    </div>
                                    <select class="form-control" name="subsidiary_id" id="subsidiary_id">
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($subsidiaries as $subsidiary)
                                            <option value="{{ $subsidiary->id }}" 
                                                @if ($subsidiary->id == $data->subsidiary->id)
                                                selected
                                                @endif>{{ $subsidiary->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="size_overflow_{{$data->id}}" style="display: none">
                            <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span></h3>
                            <p>
                                El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                            </p>
                            <p>Los archivos que has seleccionado pesan <span id="total_size_{{$data->id}}"></span>MB</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="photo">Cover </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                    </div>
                                    <input type="file" name="photo" id="photo_{{ $data->id }}" class="form-control" accept="image/*"
                                        onchange="AcceptableFileUpload('form_inputs', '0', '{{ $data->id }}', 'photo_{{ $data->id }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_{{ $data->id }}">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
