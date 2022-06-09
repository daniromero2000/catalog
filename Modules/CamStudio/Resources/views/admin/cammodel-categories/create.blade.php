@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.cammodel-categories.store') }}" method="post" class="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="parent">Categoría Padre <span class="text-danger">*</span></label>
                                    <select name="parent" id="parent" class="form-control select">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nombre <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="description">Descripción </label>
                                    <textarea class="form-control ckeditor" name="description" id="descripción" rows="5"
                                        placeholder="Descripción">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="cover">Cover </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                        </div>
                                        <input type="file" name="cover" id="cover" class="form-control" accept="image/*"
                                            onchange="AcceptableFileUpload('form_inputs', '1', '', 'cover')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="status">Estado <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                        </div>
                                        <select name="status" id="status" class="form-control">
                                            <option disabled selected value>-- Select an option --</option>
                                            <option value="0">Deshabilitado</option>
                                            <option value="1">Habilitado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.cammodel-categories.index') }}" class="btn btn-default btn-sm">Regresar</a>
                            <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
