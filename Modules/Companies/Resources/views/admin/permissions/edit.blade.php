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
                <li><a href="{{ route('admin.permissions.index') }}">Permisos</a><span class="divider"></span>
                <li class="breadactive">{{$permission->name}}</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.permissions.store') }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <h1>Crear Módulo</h1>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="name"
                            class="form-control" value="{!! $permission->name ?: old('name')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="display_name">Nombre a mostrar <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input type="text" name="display_name" id="display_name" placeholder="Nombre a mostrar"
                            validation-pattern="name" class="form-control"
                            value="{!! $permission->displya_name ?: old('display_name')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="icon">Ícono <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-grip-horizontal"></i>
                        </div>
                        <input type="text" name="icon" id="icon" placeholder="Ícono" class="form-control"
                            value="{!! $permission->icon ?: old('icon')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="icon">Descripción</label>
                    <textarea name="description" id="description" validation-pattern="text" class="form-control"
                        rows="3">{!! $permission->description ?: old('description')  !!}</textarea>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection