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
                <li class="breadactive">Editar Pqrs</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.pqrs.update', $pqr->id) }}" method="post" class="form">
            <div class="box-body">
               @csrf
                <h1>Editar PQR</h1>
               @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="text" class="form-control"
                            value="{!! $pqr->name ?: old('name')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="text" name="email" id="email" placeholder="Email" validation-pattern="email" class="form-control"
                            value="{!! $pqr->email ?: old('email')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cedula">Documento Identificación <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-id-card"></i>
                        </div>
                        <input type="text" name="cedula" id="cedula" placeholder="Documento Identificación"
                            class="form-control" value="{!! $pqr->cedula ?: old('cedula')  !!}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" name="phone" id="phone" placeholder="Teléfono" class="form-control"
                            value="{!! $pqr->phone ?: old('email')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pqr_status_id">Estado <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="pqr_status_id" id="pqr_status_id" class="form-control select2">
                            @foreach($statuses as $status)
                            <option @if($currentStatus->id == $status->id) selected="selected" @endif
                                value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.pqrs.index') }}" class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection
