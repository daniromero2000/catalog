@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.stream-account-commissions.store') }}" method="post" class="form"
            onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="row mb-2 ml-0">
                    <span class="h2 mb-0">Crear Comisión de streaming</span>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="streaming_id">Plataforma <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                                </div>
                                <select name="streaming_id" id="streaming_id" class="form-control" enabled
                                    required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($streamings as $streaming)
                                    <option value="{{ $streaming->id }}">
                                        {{ $streaming->streaming }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="amount">Valor de comisión <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="amount" id="amount" 
                                    class="form-control" value="{{ old('amount') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection
