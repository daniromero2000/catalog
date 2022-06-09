@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="post" class="form"
                enctype="multipart/form-data" id="form_inputs">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="logo">logo </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-pen"></i></span>
                                    </div>
                                    <input type="file" name="logo" id="logo_1"
                                        class="form-control" accept="image/*"
                                        onchange="AcceptableFileUpload('form_inputs', '1', '', 'logo_1')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
