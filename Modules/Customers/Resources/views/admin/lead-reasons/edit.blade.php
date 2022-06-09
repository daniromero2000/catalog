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
                            <li class="breadcrumb-item " active aria-current="page">Empleados</li>
                            <li class="breadcrumb-item active">Editar <b>{{$employee->name}}</b> </li>
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
        <form action="{{ route('admin.employees.update', $employee->id) }}" method="post" class="form">

            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="col pl-0 mb-3">
                    <h2>Actualizar</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                                    class="form-control" value="{!! $employee->name ?: old('name')  !!}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Apellido</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                    placeholder="Apellido" class="form-control"
                                    value="{!! $employee->last_name ?: old('last_name')  !!}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="text" name="email" id="email" validation-pattern="email"
                                    placeholder="Email" class="form-control"
                                    value="{!! $employee->email ?: old('email')  !!}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="employee_position_id">Cargo</label>
                            <div class="input-group">
                                <select name="employee_position_id" id="employee_position_id" class="form-control">
                                    @foreach($employee_positions as $employee_position)
                                    @if($employee_position->id == $selectedEmployeePositionId)
                                    <option selected="selected" value="{{ $employee_position->id }}">
                                        {{ $employee_position->position }}</option>
                                    @else
                                    <option value="{{ $employee_position->id }}">{{ $employee_position->position }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="department_id">Departamento</label>
                            <div class="input-group">
                                <select name="department_id" id="department_id" class="form-control">
                                    @foreach($departments as $department)
                                    @if($department->id == $selectedDepartmentId)
                                    <option selected="selected" value="{{ $department->id }}">{{ $department->name }}
                                    </option>
                                    @else
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="password" placeholder="xxxxx"
                                    class="form-control" value="{!! $employee->phone ?: old('phone')  !!}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @include('generals::admin.shared.status-select', ['status' => $employee->is_active])
                    </div>
                    <div class="col-sm-6">
                        <label class="form-control-label" for="password">Rol</label>
                        @include('generals::admin.shared.roles', ['roles' => $roles, 'selectedIds' => $selectedIds])
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</section>
@endsection