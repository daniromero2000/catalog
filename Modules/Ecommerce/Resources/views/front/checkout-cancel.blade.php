@extends('layouts.front.app')

@section('content')
<div class="container product-in-cart-list">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <p class="alert alert-warning">Has cancelado tu orden. Tal vez quieras <a
                    href="{{ route('/') }}">seleccionar otros productos?</a></p>
        </div>
    </div>
</div>
@endsection
