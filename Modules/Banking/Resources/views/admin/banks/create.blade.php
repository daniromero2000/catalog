@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.banks.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Banco</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre del Banco</label>
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
                            <label class="form-control-label" for="transer_rate">
                                Tarifa de transferencia
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                </div>
                                <input type="text" value="0" class="form-control" name="transfer_rate" id="transfer_rate"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="draft_rate">
                                Tarifa de Giro
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                </div>
                                <input type="text" value="0" class="form-control" name="draft_rate" id="draft_rate"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="is_active">Estado</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                                <select name="is_active" id="is_active" class="form-control" required>
                                    <option disabled selected value> -- Select an option -- </option>
                                    <option selected="selected" value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="country_id">País</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-flag"></i></i></span>
                                </div>
                                <select name="country_id" id="country_id" class="form-control" required>
                                    <option disabled selected value> -- Select an option -- </option>
                                    @foreach($countries as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}
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
                <a href="{{ route('admin.banks.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
