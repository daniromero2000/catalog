<!-- Modal -->
<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar {{ $data->user }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="profile">Perfil /
                                    @example</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="profile" id="profile" validation-pattern="profile"
                                        value="{{ $data->profile }}" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="user">Usuario / Correo
                                    electrónico</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="user" id="user"
                                        value="{{ $data->user }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="password">Contraseña</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="{{ $data->password }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div id="cammodel_id" class="form-group">
                                <label class="form-control-label" for="cammodel_id">Modelo</label>
                                <div class="input-group">
                                    <select name="cammodel_id" id="cammodel_id" class="form-control">
                                        <option disabled selected value> -- seleccione una opción --
                                        </option>
                                        @foreach($cammodels as $dat)
                                        <option value="{{ $dat->id }}" @if($dat->id ==
                                            $data->cammodel_id)
                                            selected="selected" @endif>
                                            {{ $dat->nickname }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="streaming_id" class="form-group">
                                <label class="form-control-label" for="streaming_id">Plataforma
                                    Streaming</label>
                                <div class="input-group">
                                    <select name="streaming_id" id="streaming_id" class="form-control">
                                        <option disabled selected value> -- seleccione una opción --
                                        </option>
                                        @foreach($streamings as $da)
                                        <option value="{{ $da->id }}" @if($da->id ==
                                            $data->streaming_id)
                                            selected="selected" @endif>
                                            {{ $da->streaming }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="corporate_phone_id" class="form-group">
                                <label class="form-control-label" for="corporate_phone_id">Teléfono</label>
                                <div class="input-group">
                                    <select name="corporate_phone_id" id="corporate_phone_id" class="form-control">
                                        <option disabled selected value> -- seleccione una opción --
                                        </option>
                                        @foreach($corporatePhones as $d)
                                        <option value="{{ $d->id }}" @if($d->id ==
                                            $data->corporate_phone_id)
                                            selected="selected" @endif>
                                            {{ $d->phone }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_api_token">Api
                                    Token</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="account_api_token"
                                        name="account_api_token" value="{{$data->account_api_token}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="password">Embed Link</label>
                                <div class="input-group input-group-merge">
                                    <textarea rows="6" class="form-control" name="embed_link" id="embed_link">
                                                                    <div class="embed-responsive embed-responsive-16by9">
                                                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen>
                                                                            {{ $data->embed_link }}
                                                                        </iframe>
                                                                    </div>
                                                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
