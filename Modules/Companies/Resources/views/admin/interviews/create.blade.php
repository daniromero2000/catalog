@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.interviews.store') }}" method="post" class="form">
            <div class="card-header">
                <div class="col pl-0 mb-3">
                    <h3>Crear Entrevista</h3>
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre <span class="text-danger">*</span></label>
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
                            <label class="form-control-label" for="last_name">Apellido <span class="text-danger">*</span></label>
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
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Email <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" name="email" id="email" validation-pattern="email"
                                    placeholder="Email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Teléfono <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone" id="phone" validation-pattern="phone"
                                    placeholder="Teléfono" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Número de Identificación <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" name="identification_number" id="identification_number"
                                    validation-pattern="text" placeholder="Número Identificación" class="form-control"
                                    value="{{ old('identification_number') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                </div>
                                <input type="date" name="birthday" id="birthday" validation-pattern="text"
                                    placeholder="Fecha de Nacimiento" class="form-control" value="{{ old('birthday') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="employee_position_id">Cargo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="employee_position_id" id="employee_position_id" class="form-control"
                                    enabled>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($employee_positions as $employee_position)
                                    <option value="{{ $employee_position->id }}">{{ $employee_position->position }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.companies.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
