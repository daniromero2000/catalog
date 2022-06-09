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
                            <li class="breadcrumb-item active" active aria-current="page">Editar Marca</li>
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
    <div class="box">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.wishlist.update', $wishlist->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    <div class="box-body">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label for="name">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                value="{{ $brand->name }}">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                @include('ecommerce::admin.shared.status-select', ['status' =>
                                $brand->is_active])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
