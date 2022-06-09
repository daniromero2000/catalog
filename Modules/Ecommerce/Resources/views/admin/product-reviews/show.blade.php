@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if($product)
    <div class="box">
        <div class="box-body">
            <table class="table-striped table">
                <thead>
                    <tr>
                        <td class="col-md-2">Nombre</td>
                        <td class="col-md-3">Descripción</td>
                        <td class="col-md-3">Cover</td>
                        <td class="col-md-2">Cantidad</td>
                        <td class="col-md-2">Precio</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @if(isset($product->cover))
                            <img src="{{ asset("storage/$product->cover") }}" class="img-responsive"
                                alt="{{$product->slug}}">
                            @endif
                        </td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ config('cart.currency') }} {{ $product->price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection