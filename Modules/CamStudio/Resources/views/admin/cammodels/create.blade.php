@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.cammodels.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Modelo</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Empleada Modelo</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                                </div>
                                <select class="form-control" name="employee_id" id="employee_id" required>
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($model_employees as $model)
                                        <option value="{{ $model->id }}">
                                            {{ $model->name }} {{ $model->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.cammodels.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
