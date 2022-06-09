@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
              @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$cammodelSocialMedias->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <div class="message" id="message">Mensaje</div>
                <tbody class="list">
                    @foreach($cammodelSocialMedias as $row => $data)
                    <tr>
                        <td class="text-center">{{ $data->cammodel->nickname }}</td>
                        <td class="text-center"><a
                                href="https://{{ $data->socialMedia->url }}/{{ $data->profile }}"><span><i
                                        class="{{ $data->socialMedia->icon }}"></i></span></a></td>
                        <td class="text-center">{{ $data->profile }}</td>
                        <td class="text-center">{{ $data->user }}</td>
                        <td class="text-center">
                            <input class="text-center border-0 changeType{{ $row }}" id="changeType" type="password"
                                value="password" data-toggle="modal" data-target="#exampleModal"
                                onclick="sendKey({{ $row }});sendPass('{{$data->id }}')">
                        </td>
                        <td class="text-center">#{{ $data->corporatePhone->simcard_number }} /
                            {{ $data->corporatePhone->phone }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar {{ $data->user }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post"
                                    class="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body py-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="profile">Perfil /
                                                        @example</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="profile" id="profile"
                                                            validation-pattern="profile" value="{{ $data->profile }}"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="user">Usuario / Correo
                                                        electrónico</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" value="{{ $data->user }}"
                                                            class="form-control" name="user" id="user">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="password">Contraseña</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="password" value="{{ $data->password }}"
                                                            class="form-control" name="password" id="password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="cammodel_id" class="form-group">
                                                    <label class="form-control-label" for="cammodel_id">Modelo</label>
                                                    <div class="input-group">
                                                        <select name="cammodel_id" id="cammodel_id"
                                                            class="form-control">
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
                                            <div class="col-sm-12">
                                                <div id="social_media_id" class="form-group">
                                                    <label class="form-control-label" for="social_media_id">Red
                                                        Social</label>
                                                    <div class="input-group">
                                                        <select name="social_media_id" id="social_media_id"
                                                            class="form-control">
                                                            <option disabled selected value>-- seleccione una opción --
                                                            </option>
                                                            @foreach($socialmedias as $da)

                                                            <option value="{{ $da->id }}" @if($da->id ==
                                                                $data->social_media_id)
                                                                selected="selected" @endif>
                                                                {{ $da->social }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div id="corporate_phone_id" class="form-group">
                                                    <label class="form-control-label"
                                                        for="corporate_phone_id">Teléfono</label>
                                                    <div class="input-group">
                                                        <select name="corporate_phone_id" id="corporate_phone_id"
                                                            class="form-control">
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
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Validation -->
                    <div class="modal validationPass fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Validación de Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Ingrese su
                                                Contraseña:</label>
                                            <input type="password" class="form-control" id="verifyPass"
                                                name="verifyPass" onkeypress="validar(event)">
                                            <input type="hidden" value="" name="passStreaming" id="passStreaming">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                                        onclick="verifyPass();">Comprobar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            @include('camstudio::admin.cammodel-social.validate')
            <input type="hidden" name="selected" id="selected">
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
    @endif
</section>
@endsection
