@extends('generals::layouts.admin.app')

@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.interview-statuses.update', $interviewStatus->id) }}" method="post">
            <div class="box-body">
                <h2>Estado de Ordenes</h2>
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name"
                        value="{{ $interviewStatus->name ?: old('name') }}" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input class="form-control jscolor {hash:true}" type="text" name="color" id="color"
                        value="{{ $interviewStatus->color ?: old('color') }}">
                </div>
            </div>
            <div class="box-footer btn-group">
                <a href="{{ route('admin.interview-statuses.index') }}" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/jscolor.min.js') }}" type="text/javascript"></script>
@endsection
