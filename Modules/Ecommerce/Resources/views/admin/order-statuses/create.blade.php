@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.order-statuses.store') }}" method="post">
            <div class="box-body">
                <h2>Estados de Ordenes</h2>
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input class="form-control jscolor" type="text" name="color" id="color" value="{{ old('color') }}">
                </div>
            </div>
            <div class="box-footer btn-group">
                <a href="{{ route('admin.order-statuses.index') }}" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/jscolor.min.js') }}" type="text/javascript"></script>
@endsection
