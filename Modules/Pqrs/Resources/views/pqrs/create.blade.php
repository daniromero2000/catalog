@extends('generals::layouts.admin.app')
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.pqrs.index') }}">Pqrs</a><span class="divider"></span>
                <li class="breadactive">Crear Pqrs</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.pqrs.store') }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <h1>Crear PQR</h1>
                <div class="form-group">
                    <label for="name">Nombre Usuario<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="name" id="name" validation-pattern="text" placeholder="Nombre"
                            class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="text" name="email" id="email" placeholder="Email" validation-pattern="email"
                            class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cedula">Documento Identificación <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <input type="text" name="cedula" id="cedula" validation-pattern="IdentificationNumber"
                            placeholder="Documento Identificación" class="form-control" value="{{ old('cedula') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="">Teléfono <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" name="phone" required id="phone" validation-pattern="telephone"
                            placeholder="Teléfono móvil" class="form-control" required>
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group hidden">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="xxxxx" class="form-control"
                        value="12345678">
                </div>
                <div class="form-group">
                    <label for="pqr_status_id" class="">Estado <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="pqr_status_id" id="pqr_status_id" class="form-control select2">
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input class="hidden" id="lead" type="text" class="form-control" name="lead" value="Administración">
                <div class="form-group">
                    <label for="pqr" class="control-label">Tipo de PQR</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select class="selectpicker form-control form-controlPqrs " id="pqr" name="pqr">
                            <option>Pregunta</option>
                            <option>Queja</option>
                            <option>Reclamo</option>
                            <option>Solicitud</option>
                        </select>
                    </div>
                </div>
                <div id="cities" class="form-group">
                    <label for="city_id">Ciudad <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <select name="city_id" id="city_id" class="form-control form-controlPqrs" enabled>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('asunto') ? ' has-error' : '' }}"> <input id="asunto"
                        type="asunto" class="form-control form-controlPqrs" validation-pattern="textOnly" name="asunto"
                        placeholder="Asunto" value="{{ old('asunto') }}" required>
                    @if($errors->has('asunto')) <span class="help-block">
                        <strong>{{ $errors->first('asunto') }}</strong> </span> @endif</div>

                <div class="form-group{{ $errors->has('mensaje') ? ' has-error' : '' }}"> <textarea id="mensaje"
                        type="mensaje" class="form-control" name="mensaje" placeholder="Mensaje"
                        value="{{ old('mensaje') }}" validation-pattern="text" required></textarea>
                    @if($errors->has('mensaje')) <span class="help-block">
                        <strong>{{ $errors->first('mensaje') }}</strong> </span> @endif</div>
            </div>

            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.pqrs.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection