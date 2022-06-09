@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
               @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$EmployeeActions->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <tbody>
                    @foreach($EmployeeActions as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->permission->display_name }}</td>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center"><i class="{{ $data->icon }}"></i></td>
                        <td class="text-center">{{ $data->route }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.actions.update', $data->id) }}" method="post"
                                    class="form" onsubmit="disable_button('create_button_')">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body py-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">Nombre 
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                                        </div>
                                                        <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="name"
                                                            class="form-control" value="{{ $data->name }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
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
                                                            value="{{ $data->icon }}" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text text-primary">
                                                                <i id="selected_icon"
                                                                    class=""></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="icon">Permiso 
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="permission_id" id="permission_id">
                                                        <option value selected disabled>--select an option--</option>
                                                        @foreach ($permissions as $permission)
                                                            <option value="{{ $permission->id }}"
                                                                @if ($data->permission_id == $permission->id)
                                                                selected        
                                                                @endif>
                                                                {{ $permission->display_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="icon">Acceso desde Sidebar 
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="principal" id="principal">
                                                        <option value="1"
                                                            @if ($data->principal == 1)
                                                            selected        
                                                            @endif>Sí</option>
                                                        <option value="0"
                                                            @if ($data->principal == 0)
                                                            selected        
                                                            @endif>No</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">Ruta 
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-font"></i></span>
                                                        </div>
                                                        <input type="text" name="route" id="route" placeholder="admin.permission.action"
                                                            pattern="[a-z]*[.][a-z\-]*[.][a-z\-]*"
                                                            class="form-control" value="{{ $data->route }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="icon">Descripción</label>
                                                    <textarea name="description" id="description" class="form-control" validation-pattern="text"
                                                        rows="3">{{ $data->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            id="create_button_">Actualizar</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip])
    @endif
</section>
<script>
    function icon_change(icon){
        target = document.getElementById(icon).value;
        document.getElementById('selected_'+icon).className = target;
    }
</script>
@endsection
