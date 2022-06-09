@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.contract-rates.store') }}" method="post" class="form"
            onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Tarifas de Contrato</h2>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="percentage">Porcentaje <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                </div>
                                <input type="text" name="percentage" id="percentage" validation-pattern="percentage"
                                    placeholder="Porcentaje" class="form-control" value="{{ old('percentage') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="type">Tipo <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                                <select name="type" id="type" class="form-control" required>
                                    <option selected="selected" value="0">
                                        Normal</option>
                                    <option value="1">Especial
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="value">Valor <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="value" id="value" validation-pattern="value"
                                    placeholder="Valor" class="form-control" value="{{ old('value') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                <a href="{{ route('admin.contract-rates.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
