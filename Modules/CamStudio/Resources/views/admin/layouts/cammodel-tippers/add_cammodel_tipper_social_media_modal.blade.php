<div class="modal fade" id="addSocialAccountModal" tabindex="-1" role="dialog" 
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Red Social</h5>
                <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodel-tipper-social-medias.store') }}" 
                method="post" class="form">
                @csrf
                <div class="modal-body py-0">
                    <input name="cammodel_tipper_id" id="cammodel_tipper_id" 
                        type="hidden" value="{{ $cammodelTipper->id }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label" for="profile">
                                    Perfil</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="profile" 
                                        validation-pattern="text" id="profile"
                                        placeholder="Perfil" 
                                        class="form-control" 
                                        value="{{ old('profile') }}" required
                                        autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" 
                                    for="social_media_id">Red Social</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-share-alt"></i>
                                        </span>
                                    </div>
                                    <select name="social_media_id" 
                                        id="social_media_id" 
                                        class="form-control">
                                        <option value selected disabled>
                                            --select an option--
                                        </option>
                                        @foreach ($socialMedias as $socialMedia)
                                        <option value="{{ $socialMedia->id }}">
                                            {{ $socialMedia->social }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-100 p-3 text-right">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" 
                        data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
