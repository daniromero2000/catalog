@extends('generals::layouts.admin.app')
@section('styles')
<style>
    .relative {
        position: relative;
    }

    .remove-img {
        position: absolute;
        top: 5px;
        width: 29px;
        right: 5px;
    }

    @media (max-width: 700px) {
        .remove-img {
            width: 0px;
            padding-right: 12px;
            right: 0px;
            font-size: 8px;
        }
    }

</style>
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Editar Categoría</li>
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
    <div class="card">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="form"
            enctype="multipart/form-data" id="form_inputs">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7 col-lg-6">
                        <input type="hidden" name="_method" value="put">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="parent">Categoría Padre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-tag"></i></span>
                                </div>
                                <select name="parent" id="parent" class="form-control select2">
                                    <option value="0">Sin padre</option>
                                    @foreach($categories as $cat)
                                    <option @if($cat->id == $category->parent_id) selected="selected" @endif
                                        value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                </div>
                                <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                    value="{!! $category->name ?: old('name')  !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="description">Descripción </label>
                            <textarea class="form-control ckeditor" name="description" id="description" rows="5"
                                placeholder="Descripción">{!! $category->description ?: old('description')  !!}</textarea>
                        </div>

                        <div class="col-sm-6 px-0">
                            <div class="form-group">
                                @include('ecommerce::admin.shared.status-select', ['status' =>
                                $category->is_active])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        @if(isset($category->cover))
                        <div class="card-body">
                            <div class="d-flex" style=" position: relative; ">
                                <img src="{{ asset("storage/$category->cover") }}" alt="{{$category->slug}}"
                                    class=" mx-auto img-fluid lazy" style="border-radius: 15px;max-height: 330px;">
                                <br />
                                <a onclick="return confirm('¿Estás Seguro?')"
                                    href="{{ route('admin.category.remove.image', ['category' => $category->id, 'src' => $category->cover]) }}"
                                    class="btn btn-danger remove-img btn-sm btn-block"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>

                        @endif
                        <div class="form-group">
                            <label class="form-control-label" for="cover">Cover</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                </div>
                                <input type="file" name="cover" id="cover"
                                class="form-control" accept="image/*"
                                onchange="AcceptableFileUpload('form_inputs', '1', '')">
                            </div>
                        </div>
                        @if(isset($category->banner))
                        <div class="card-body">
                            <div class="d-flex" style=" position: relative; ">
                                <img src="{{ asset("storage/$category->banner") }}" alt="{{$category->slug}}"
                                    class=" mx-auto img-fluid lazy" style="border-radius: 15px;max-height: 330px;">
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-control-label" for="banner">Banner </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                </div>
                                <input type="file" name="banner" id="banner" class="form-control" accept="image/*"
                                onchange="AcceptableFileUpload('form_inputs', '1', '')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Actualizar</button>
            </div>
        </form>
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
