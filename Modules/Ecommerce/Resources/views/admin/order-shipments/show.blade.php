@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4 w-100">
                <div class=" col-12">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.order-shipments.index') }}">Despachos</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">{{ ucfirst($customer->name) }}
                                {{$customer->last_name}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if($orderShipment)
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card">
                    <div class="card-header">
                        <h4> <i class="fa fa-truck"></i> Informaci&oacute;n Despacho Orden</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table align-items-center table-flush table-hover ">
                                <tbody>
                                    <tr>
                                        <td>Orden #: </td>
                                        <td><b>{{$orderShipment->order->id}}</b></td>
                                        <td>Referencia:</td>
                                        <td><b>{{ $orderShipment->order->reference}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Courier:</td>
                                        <td><b>{{ $courier }}</b></td>
                                        <td>Cantidad:</td>
                                        <td><b>{{ $orderShipment->total_qty }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Peso:</td>
                                        <td><b>{{ $orderShipment->total_weight }}</b></td>
                                        <td>Numero Guia:</td>
                                        <td><b>{{ $orderShipment->track_number }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Ciudad:</td>
                                        <td><b>
                                            @if(isset($city))
                                            {{ $city }}
                                            @endif
                                            </b>
                                        </td>
                                        <td>Departamento:</td>
                                        <td>
                                            <b>
                                                @if(isset($orderShipment->order->address->city))
                                                {{ $orderShipment->order->address->city->province->province }}
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Direcci&oacute;n:</td>
                                        <td><b>{{ $address }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                        
                    </div>

                </div>
            </div>
        </div>
        @if($orderShipment->order)
            @if($orderShipment->order->grand_total != $orderShipment->order->total_paid)
                <p class="alert alert-danger">
                    Ooops, hay una discrepancia en el monto total de la orden y el monto pagado <br />
                    Monto Total de orden: <strong>{{ config('cart.currency') }} {{ $orderShipment->order->grand_total }}</strong> <br>
                    Monto Total Pagado <strong>{{ config('cart.currency') }} {{ $orderShipment->order->total_paid }}</strong>
                </p>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="w-100 p-3">
                            <h4> <i class="fa fa-gift"></i> Items</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table-striped table text-center table-flush table-hover">
                                <thead class="thead-light">
                                    <th>SKU</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Peso</th>
                                    <th>Precio</th>
                                </thead>
                                <tbody>
                                    @foreach($orderShipment->shipmentItems as $item)
                                    <tr>
                                        <td>{{ $item->sku }} </td>
                                        <td>{{ $item->name }} </td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->weight }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</section>
@endsection