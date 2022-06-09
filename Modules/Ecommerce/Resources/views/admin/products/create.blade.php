@extends('generals::layouts.admin.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('front/carousel/glider.css')}}">
<script src="{{ asset('front/carousel/glider.js')}}"></script>
<script src="{{ asset('admin/js/carousel.js')}}"></script>
<style type="text/css">
    .info-tooltip {
        position: absolute;
        top: 3px;
        right: 18px;
        border-radius: 20px;
        background: #5e72e4;
        width: 18px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        color: white !important;
    }

    .relative {
        position: relative;
    }

</style>
@endsection
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.products.store') }}" method="post" class="form" enctype="multipart/form-data"
            id="form_inputs">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Producto</h2>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-6">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="sku">SKU <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="sku" id="sku" placeholder="xxxxx" class="form-control"
                                            value="{{ old('sku') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="quantity">Cantidad <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="quantity" id="quantity" placeholder="Cantidad"
                                            class="form-control" value="{{ old('quantity') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="price">Precio Normal <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" name="price" id="price" placeholder="Precio Normal"
                                            class="form-control" value="{{ old('price') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Categorías <span
                                            class="text-danger">*</span></label></label>
                                    @include('ecommerce::admin.shared.categories', ['categories' => $categories,
                                    'selectedIds' =>
                                    []])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">

                        <div class="form-group">
                            <label for="cover" class="form-control-label">Cover <span
                                    class="text-danger">*</span></label></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                </div>
                                <input type="file" name="cover" id="cover" class="form-control" accept="image/*"
                                    onchange="AcceptableFileUpload('form_inputs', '1', '')">
                            </div>
                        </div>
                        <div class="form-group relative">
                            <label for="image" class="form-control-label">Imagenes <span
                                    class="text-danger">*</span></label></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                </div>
                                <input type="file" name="image[]" id="image" class="form-control" multiple
                                    accept="image/*" onchange="AcceptableFileUpload('form_inputs', '1', '')">
                            </div>
                            <a class="text-center info-tooltip" data-toggle="tooltip"
                                data-original-title="Puedes usar (cmd o ctrl) para seleccionar multiples imagenes">
                                ! </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
            </div>
        </form>
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
