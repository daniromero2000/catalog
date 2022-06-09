@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <h3>Crear {{ $module }}</h3>
        </div>
        <form action="{{ route('admin.kpis.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="min_fortnight_goal">Meta mínima quincenal 
                                <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-dollar-sign"></i></span>
                                </div>
                                <input type="decimal" name="min_fortnight_goal" id="min_fortnight_goal" 
                                    placeholder="2000,00" validation-pattern="min_fortnight_goal"
                                    class="form-control" value="{{ old('min_fortnight_goal') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Sede 
                                <span class="text-danger">*</span></label>
                            <select class="form-control" name="subsidiary_id" id="subsidiary_id">
                                <option value selected disabled>--select an option--</option>
                                @foreach ($subsidiaries as $subsidiary)
                                    <option value="{{ $subsidiary->id }}">{{ $subsidiary->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Turno 
                                <span class="text-danger">*</span></label>
                            <select class="form-control" name="shift_id" id="shift_id">
                                <option value selected disabled>--select an option--</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.kpis.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection