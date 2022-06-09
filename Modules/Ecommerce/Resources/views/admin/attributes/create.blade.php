@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <h3>Crear Atributo</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attributes.store') }}" method="post" class="form">
                <div class="row">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre del Atributo<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Nombre " class="form-control"
                                value="{!! old('name')  !!}" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('admin.attributes.index') }}" class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
