@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-body">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            <a href="{{ route('admin.customers.show', $customer->id) }}">{{$customer->name}}</a> <br />
                            <small>{{$customer->email}}</small> <br />
                            <small>Referencia: <strong>{{$order->reference}}</strong></small>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fa fa-shopping-bag"></i> Información de la Orden</h4>
                    <table class="table-striped table">
                        <thead>
                            <tr>
                                <td class="col-md-3">Fecha</td>
                                <td class="col-md-3">Cliente</td>
                                <td class="col-md-3">Pago</td>
                                <td class="col-md-3">Estado</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</td>
                                <td><a
                                        href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }}</a>
                                </td>
                                <td><strong>{{ $order['payment'] }}</strong></td>
                                <td>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="put">
                                        <label for="order_status_id" class="hidden">Actualizar Estado</label>
                                        <input type="text" name="total_paid" class="form-control"
                                            placeholder="Total paid" style="margin-bottom: 5px; display: none"
                                            value="{{ old('total_paid') ?? $order->total_paid }}" />
                                        <div class="input-group">
                                            <select name="order_status_id" id="order_status_id"
                                                class="form-control select2">
                                                @foreach($statuses as $status)
                                                <option @if($currentStatus->id == $status->id) selected="selected"
                                                    @endif
                                                    value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-btn"><button
                                                    onclick="return confirm('¿Estás Seguro?')" type="submit"
                                                    class="btn btn-primary">Actualizar</button></span>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Subtotal</td>
                                <td>${{ number_format($order['sub_total'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Impuesto</td>
                                <td>${{ number_format($order['tax_amount'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Descuento</td>
                                <td>${{ number_format($order['discounts'],0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Envío</td>
                                <td>${{ number_format($order['total_shipping'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total de orden</td>
                                <td>${{ number_format($order['grand_total'], 0) }}</td>
                            </tr>
                            @if($order['total_paid'] != $order['grand_total'])
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Pagado</td>
                                <td>${{ number_format($order['total_paid'], 0) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($order)
    @if($order->grand_total != $order->total_paid)
    <p class="alert alert-danger">
        Ooops, hay una discrepancia en el monto total de la orden y el monto pagado <br />
        Monto Total de orden: <strong>{{ config('cart.currency') }} {{ $order->grand_total }}</strong> <br>
        Monto Total Pagado <strong>{{ config('cart.currency') }} {{ $order->total_paid }}</strong>
    </p>
    @endif
    <div class="box">
        @if(!$items->isEmpty())
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fa fa-gift"></i> Items</h4>
                    <table class="table-striped table">
                        <thead>
                            <th class="col-md-2">SKU</th>
                            <th class="col-md-2">Nombre</th>
                            <th class="col-md-2">Descripción</th>
                            <th class="col-md-2">Cantidad</th>
                            <th class="col-md-2">Precio</th>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4> <i class="fa fa-truck"></i> Envío</h4>
                            <table class="table-striped table">
                                <thead>
                                    <th class="col-md-3">Nombre</th>
                                    <th class="col-md-4">Descripción</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->courier->name }}</td>
                                        <td>{{ $order->courier->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4> <i class="fa fa-map-marker"></i> Dirección</h4>
                            <table class="table-striped table">
                                <thead>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Departamento</th>
                                    <th>Zip</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->address->customer_address }}</td>
                                        <td>
                                            @if(isset($order->address->city))
                                            {{ $order->address->city->city }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($order->address->city))
                                            {{ $order->address->city->province->province }}
                                            @endif
                                        </td>
                                        <td>{{ $order->address->zip }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="btn-group">
            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
    @endif
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
            let osElement = $('#order_status_id');
            osElement.change(function () {
                if (+$(this).val() === 1) {
                    $('input[name="total_paid"]').fadeIn();
                } else {
                    $('input[name="total_paid"]').fadeOut();
                }
            });
        })
</script>
@endsection
