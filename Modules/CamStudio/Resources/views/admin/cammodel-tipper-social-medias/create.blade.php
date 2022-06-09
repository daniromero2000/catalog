@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.cammodel-tipper-social-medias.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Red social de Tipper</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="cammodel_tipper_id">Tipper</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                                </div>
                                <select class="form-control" name="cammodel_tipper_id" id="cammodel_tipper_id" required>
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($cammodelTippers as $cammodelTipper)
                                        <option value="{{ $cammodelTipper->id }}">{{ $cammodelTipper->profile }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="social_media_id">Red social</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                </div>
                                <select class="form-control" name="social_media_id" id="social_media_id" required>
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($socialMedias as $socialMedia)
                                        <option value="{{ $socialMedia->id }}">{{ $socialMedia->social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="profile">Perfil</label>
                            <input class="form-control" type="text" name="profile">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.cammodel-tipper-social-medias.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
