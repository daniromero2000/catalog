@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.corporate-phones.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Teléfono Corporativo</h2>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="simcard_number">Número de Simcard</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="simcard_number" id="simcard_number" validation-pattern="simcard_number"
                                    placeholder="Número de Simcard" class="form-control" value="{{ old('simcard_number') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="operator">Operador</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                                <select name="operator" id="operator" class="form-control">
                                    <option selected="selected" value="CLARO">
                                        CLARO</option>
                                    <option value="TIGO">TIGO
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="phone">Número de Teléfono<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="phone" id="phone" validation-pattern="phone"
                                    placeholder="Número de Teléfono" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-control-label" for="description">Descripción</label>
                            <div class="input-group input-group-merge">
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.corporate-phones.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
