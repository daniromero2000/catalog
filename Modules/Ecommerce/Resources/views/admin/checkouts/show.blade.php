@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h2>
                        <a href="{{ route('admin.customers.show', $customer->id) }}">{{$customer->name}}
                            {{$customer->last_name}}</a> <br />
                        <small>{{$customer->email}}</small> <br />
                    </h2>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.checkouts.index') }}" class="btn btn-default btn-sm">Regresar</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="card">
                <div class="card-header">
                    <h4> <i class="fa fa-shopping-bag"></i> Información de Checkout</h4>
                </div>
                <table class="table-striped table">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ date('M d, Y h:i a', strtotime($checkout['created_at'])) }}</td>
                            <td class="text-center" <a href="{{ route('admin.customers.show', $customer->id) }}">
                                {{ $customer->name }}
                                {{ $customer->last_name }}</a>
                            </td>
                            {{-- <td class="text-center" <strong>{{ $checkout['payment'] }}</strong></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
            @if(!$items->isEmpty())
            <div class="card">
                <div class="card-header">
                    <h4> <i class="fa fa-gift"></i> Items</h4>
                </div>
                <table class="table-striped table">
                    <thead class="thead-light">
                        <th class="text-center">SKU</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio</th>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="text-center">{{ $item->sku }}</td>
                            <td class="text-center">{{ $item->name }} </td>
    
                            <td class="text-center">{{ $item->pivot->quantity }}</td>
                            <td class="text-center">${{ $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
