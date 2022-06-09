@extends('generals::layouts.admin.app')

@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.bank-movements.update', $orderStatus->id) }}" method="post">
            <div class="box-body">
                <h2>Movimiento de bancos</h2>
                @csrf
                <input type="hidden" name="_method" value="put">
            </div>
            <div class="box-footer btn-group">
                <a href="{{ route('admin.bank-movements.index') }}" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/jscolor.min.js') }}" type="text/javascript"></script>
@endsection
