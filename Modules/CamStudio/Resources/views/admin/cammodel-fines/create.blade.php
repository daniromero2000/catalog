@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.cammodel-fines.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Falta</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="cammodel_id">Modelo</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                                </div>
                                <select class="form-control" name="cammodel_id" id="cammodel_id" required>
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($cammodels as $cammodel)
                                        <option value="{{ $cammodel->id }}">{{ $cammodel->nickname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="foul_id">Falta</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-ban"></i></span>
                                </div>
                                <select class="form-control" name="foul_id" id="foul_id" required>
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($fouls as $foul)
                                        <option value="{{ $foul->id }}">{{ $foul->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.cammodel-fines.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
