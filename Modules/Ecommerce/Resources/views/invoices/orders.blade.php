<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de Orden</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style type="text/css">
        table { border-collapse: collapse;}
    </style>
</head>
<body>
    <section class="row">
        <div class="pull-left">
            Factura a: {{$customer->name}} <br />
            Entregada a: <strong>{{ $address->alias }} <br /></strong>
            {{ $address->address }} <br />
            {{ $address->city->city }} {{ $address->city->province->province }} <br />
            {{ $address->city->province->country->name }} {{ $address->zip }}
        </div>
        <div class="pull-right">
            From: {{config('app.name')}}
        </div>
    </section>
    <section class="row">
        <div class="col-md-12">
            <h2>Details</h2>
            <table class="table-striped table " width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{number_format($product->price * $product->pivot->quantity, 2)}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Subtotal:</td>
                        <td>{{$order->sub_total}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Descuentos:</td>
                        <td>{{$order->discounts}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Impuesto:</td>
                        <td>{{$order->tax_amount}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Total:</strong></td>
                        <td><strong>{{$order->grand_total}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
</body>
</html>