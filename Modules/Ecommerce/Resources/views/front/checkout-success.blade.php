@extends('layouts.front.app')

@section('content')
<div class="container product-in-cart-list">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <p class="alert alert-success">Tu orden está en camino! <a href="{{ route('/') }}">Mostrar más!</a></p>
        </div>
    </div>
</div>
@endsection
