@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="card">
            <h1>
                Vista create wishlist
            </h1>
            <div class="card-body">
                <form action="{{ route('admin.wishlist.store') }}" method="post" class="form"
                    enctype="multipart/form-data">
                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
