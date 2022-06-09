@extends('generals::layouts.admin.app')
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')

    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.pqr-statuses.update', $pqrStatus->id) }}" method="post">
            <div class="box-body">
                <h1>Editar Estado Clientes</h1>
               @csrf
               @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $pqrStatus->name ?: old('name') }}" placeholder="Nombre"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="color">Color <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-paint-brush"></i>
                        </div>
                        <input class="form-control jscolor {hash:true}" type="text" name="color" id="color" value="{{ $pqrStatus->color ?: old('color') }}"
                            required>
                    </div>
                </div>
            </div>

            <div class="box-footer btn-group">
                <a href="{{ route('admin.pqr-statuses.index') }}" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>

</section>
@include('layouts.admin.jscolor')
@endsection


