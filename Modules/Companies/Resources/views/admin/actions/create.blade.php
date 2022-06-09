@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <h3>Crear {{ $module }}</h3>
        </div>
        <form action="{{ route('admin.actions.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre 
                                <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                </div>
                                <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="name"
                                    class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Ícono <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-image"></i></span>
                                </div>
                                <input type="text" name="icon" id="icon"
                                    placeholder="Ícono" class="form-control"
                                    onchange="icon_change('icon')"
                                    value="{{ old('icon') }}" required>
                                <div class="input-group-append">
                                    <span class="input-group-text text-primary">
                                        <i id="selected_icon"
                                            class=""></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Permiso 
                                <span class="text-danger">*</span></label>
                            <select class="form-control" name="permission_id" id="permission_id">
                                <option value selected disabled>--select an option--</option>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Acceso desde Sidebar 
                                <span class="text-danger">*</span></label>
                            <select class="form-control" name="principal" id="principal">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Ruta 
                                <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                </div>
                                <input type="text" name="route" id="route" placeholder="admin.permission.action"
                                    pattern="[a-z]*[.][a-z\-]*[.][a-z\-]*"
                                    class="form-control" value="{{ old('route') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Descripción</label>
                            <textarea name="description" id="description" class="form-control" validation-pattern="text"
                                rows="3">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.actions.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>
</section>
<script>
    function icon_change(icon){
        target = document.getElementById(icon).value;
        document.getElementById('selected_'+icon).className = target;
    }
</script>
@endsection