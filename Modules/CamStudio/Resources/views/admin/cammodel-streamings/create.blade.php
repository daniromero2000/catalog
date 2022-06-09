@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.cammodel-streamings.store') }}" method="post" class="form" onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear cuenta streaming de modelo</h2>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="profile">Perfil / @example</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="profile" id="profile" validation-pattern="profile"
                                    placeholder="Nombre" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="user">Usuario / Correo electrónico</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" value="" class="form-control" name="user" id="user"
                                    placeholder="example@example.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="password">Contraseña</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="password" value="" class="form-control" name="password" id="password"
                                    placeholder="***********" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div id="cammodel_id" class="form-group">
                            <label class="form-control-label" for="cammodel_id">Modelo</label>
                            <div class="input-group">
                                <select name="cammodel_id" id="cammodel_id" class="form-control" required>
                                    <option disabled selected value> -- seleccione una opción -- </option>
                                    @foreach($cammodels as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->nickname }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="streaming_id" class="form-group">
                            <label class="form-control-label" for="streaming_id">Plataforma Streaming</label>
                            <div class="input-group">
                                <select name="streaming_id" id="streaming_id" class="form-control" required>
                                    <option disabled selected value> -- seleccione una opción -- </option>
                                    @foreach($streamings as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->streaming }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="corporate_phone_id" class="form-group">
                            <label class="form-control-label" for="corporate_phone_id">Teléfono Asociado</label>
                            <div class="input-group">
                                <select name="corporate_phone_id" id="corporate_phone_id" class="form-control" required>
                                    <option disabled selected value> -- seleccione una opción -- </option>
                                    @foreach($corporatePhones as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->phone }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                <a href="{{ route('admin.cammodel-streamings.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@include('generals::layouts.admin.buttons.disable_button')
@endsection
