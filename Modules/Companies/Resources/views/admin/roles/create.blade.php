@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.roles.store') }}" method="post" class="form">
            <div class="card-header">
                <h3>Crear Rol</h3>
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label class="form-control-label" for="display_name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                        </div>
                        <input type="text" name="display_name" id="display_name" validation-pattern="name"
                            placeholder="Nombre" class="form-control" value="{{ old('display_name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="description">Descripción <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control" validation-pattern="text"
                        required placeholder="Descripción">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection
