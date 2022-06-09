@extends('generals::layouts.admin.app')
@section('content')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$role->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="form">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 text-left">
                        <span class="h3">Permisos del Rol</span>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                            class="btn btn-sm btn-primary">
                            Editar Acciones
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @csrf
                <input type="hidden" value="put" name="_method">
                <div class="form-group mb-0">
                    @include('companies::admin.roles.layouts.permissions', ['permissions' =>
                    $permissions,
                    'ids' => $attachedPermissionsArrayIds])
                </div>
                {{-- <div class="col-12">
                    <div class="form-group">
                        <label class="form-control-label">Acciones del Rol</label>
                        @include('companies::admin.roles.layouts.actions', ['actions' =>
                        $actions,
                        'ids' => $attachedActionsArrayIds])
                    </div>
                </div> --}}
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-default">Regresar</a>
                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</section>
@endsection
