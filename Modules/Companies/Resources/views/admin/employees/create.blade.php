@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.employees.store') }}" method="post" class="form" onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Empleado</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                                    class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Apellido</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                    placeholder="Apellido" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="employee_position_id">Cargo</label>
                            <div class="input-group">
                                <select name="employee_position_id" id="employee_position_id" class="form-control"
                                    enabled required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($employee_positions as $employee_position)
                                    <option value="{{ $employee_position->id }}">{{ $employee_position->position }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="subsidiaries" class="form-group">
                            <label class="form-control-label" for="department_id">Sucursal</label>
                            <div class="input-group">
                                <select name="subsidiary_id" id="subsidiary_id" class="form-control" enabled required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($subsidiaries as $subsidiary)
                                    <option value="{{ $subsidiary->id }}">{{ $subsidiary->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                <a href="{{ route('admin.companies.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@include('generals::layouts.admin.buttons.disable_button')
@endsection
