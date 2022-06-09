@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Crear Categoría</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data" id="form_inputs">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="parent">Categoría Padre </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-tag"></i></span>
                                        </div>
                                        <select name="parent" id="parent" class="form-control select2">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nombre <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Nombre"
                                            class="form-control" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="size_overflow_" style="display: none">
                                <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </span></h3>
                                <p>
                                    El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                                </p>
                                <p>Los archivos que has seleccionado pesan <span id="total_size_"></span>MB</p>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cover" class="form-control-label">Cover </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                        </div>
                                        <input type="file" name="cover" id="file_logo" class="form-control"
                                            accept="image/*"
                                            onchange="AcceptableFileUpload('form_inputs', '0', '', 0, '1')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="banner" class="form-control-label">Banner </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                        </div>
                                        <input type="file" name="banner" id="file_commerce" class="form-control"
                                            accept="image/*"
                                            onchange="AcceptableFileUpload('form_inputs', '0', '', 0, '1')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">Estado </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                        </div>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0">Deshabilitado</option>
                                            <option value="1">Habilitado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="description" class="form-control-label">Descripción </label>
                            <div class="input-group input-group-merge">
                                <textarea class="form-control ckeditor" name="description" id="descripción" rows="5"
                                    placeholder="Descripción">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-default">Regresar</a>
                <button type="submit" class="btn btn-sm btn-primary" id="create_button_">Crear</button>
            </div>
        </div>
    </form>

</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
