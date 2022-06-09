<div class="modal fade" id="modal{{ $cammodelTipper->id }}" tabindex="-1" role="dialog" 
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="h5 modal-title">Actualizar datos de 
                    {{ $cammodelTipper->profile }}</span>
                <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodel-tippers.update', $cammodelTipper->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-control-label" for="profile">
                                Perfil
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> 
                                        <i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" class="form-control" 
                                    value="{{ $cammodelTipper->profile }}" 
                                    name="profile">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="form-control-label" for="streaming_id">Plataforma</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                                </div>
                                <select class="form-control" name="streaming_id" id="streaming_id" required>
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($streamings as $streaming)
                                        <option value="{{ $streaming->id }}"
                                            @if ($streaming->id == $cammodelTipper->streaming_id)
                                                selected
                                            @endif
                                            >{{ $streaming->streaming }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="form-control-label" for="nickname">
                                Apodos
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> 
                                        <i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" class="form-control" 
                                    value="{{ $cammodelTipper->nickname }}" 
                                    name="nickname">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="form-control-label" for="birthday">
                                Cumpleaños
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> 
                                        <i class="fas fa-birthday-cake"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" 
                                    value="{{ $cammodelTipper->birthday }}" 
                                    name="birthday">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="form-control-label" for="location">
                                Ubicación
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> 
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" 
                                value="{{ $cammodelTipper->location }}" 
                                name="location">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group mb-0">
                                <label class="form-control-label">Gustos
                                </label>
                                <div class="input-group">
                                    <textarea name="pleasures" rows="4"
                                        class="form-control" 
                                        aria-label="With textarea"
                                        >{{$cammodelTipper->pleasures}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group">
                                <label class="form-control-label">Observaciones
                                </label>
                                <div class="input-group">
                                    <textarea name="observations" 
                                        rows="4" class="form-control" 
                                        aria-label="With textarea"
                                        >{{$cammodelTipper->observations}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
