<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style type="text/css">
        table {
            border-collapse: collapse;
        }


        .card {
            margin-bottom: 30px;
            border: 0;
        }

        header {
            background-color: #fff;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .text-center {
            text-align: center !important;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
        }

        .row {
            display: -ms-flexbox !important;
            display: flex !important;
            -ms-flex-wrap: wrap !important;
            flex-wrap: wrap !important;
            margin-right: -15px !important;
            margin-left: -15px !important;
        }

        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                -ms-flex: 0 0 33.333333% !important;
                flex: 0 0 33.333333% !important;
                max-width: 33.333333% !important;
            }

            .col-md-5 {
                -ms-flex: 0 0 41.666667% !important;
                flex: 0 0 41.666667% !important;
                max-width: 41.666667% !important;
            }

            .justify-content-md-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important;
            }

            .col-md-6 {
                -ms-flex: 0 0 50% !important;
                flex: 0 0 50% !important;
                max-width: 50% !important;
            }
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .mt-5,
        .my-5 {
            margin-top: 3rem !important;
        }

        @media (min-width: 992px) {
            .col-lg-3 {
                -ms-flex: 0 0 25% !important;
                flex: 0 0 25% !important;
                max-width: 25% !important;
            }

            .col-lg-4 {
                -ms-flex: 0 0 33.333333% !important;
                flex: 0 0 33.333333% !important;
                max-width: 33.333333% !important;
            }
        }

        .card-body {
            flex: 1 1 auto !important;
            padding: 1.5rem !important;
        }

        .col-12 {
            -ms-flex: 0 0 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100%;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        table {
            border-collapse: collapse;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .mb-1,
        .my-1 {
            margin-bottom: .25rem !important;
        }

        .h6,
        h6 {
            font-size: 1rem;
        }

        .d-block {
            display: block !important;
        }

        .small,
        small {
            font-size: 80%;
            font-weight: 400;
        }

        .text-left {
            text-align: left !important;
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .card .card-footer,
        .card .card-header {
            background-color: #fff;
        }

        .text-right {
            text-align: right !important;
        }

        .card .card-footer,
        .card .card-header {
            background-color: #fff;
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important;
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px);
        }

        .card-footer {
            padding: .75rem 1.25rem;
            background-color: rgba(0, 0, 0, .03);
            border-top: 1px solid rgba(0, 0, 0, .125);
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.5rem;
        }

        .bg-default {
            background-color: #172b4d !important;
            color: white;
        }

        .table thead th {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: .0625rem solid #dee2e6;
        }

        .text-muted {
            color: #8898aa !important;
        }

        .table td,
        .table th,
        .table td p {
            font-size: .8125rem;
            white-space: nowrap;
        }

        .table th {
            font-weight: 600;
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: top;
            border-top: .0625rem solid #dee2e6;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-family: inherit;
            font-weight: 400;
            line-height: 1.5;
            color: #32325d;
        }

        body {
            margin: 0;
            font-family: Open Sans, sans-serif !important;
            font-size: 1rem !important;
            font-weight: 400;
            line-height: 1.5;
            color: #525f7f;
            text-align: left;
            background-color: #fff;
        }

        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1250px;
            }

        }

        @media (max-width: 575px) {

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                padding-right: 8px !important;
                padding-left: 8px !important;
            }


            .col-md-10 {
                padding-right: 0px !important;
                padding-left: 0px !important;
            }
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important;
        }

        @media (min-width: 768px) {
            .col-md-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%;
            }
        }

        .h3,
        h3 {
            font-size: 1.75rem;
        }

        .h4,
        h4 {
            font-size: 1.5rem;
        }

        .h5,
        h5 {
            font-size: 1.25rem;
            margin-top: 0px;
        }

        .h6,
        h6 {
            font-size: 1rem;
            margin-top: 0px;
        }

        .mr-auto,
        .mx-auto {
            margin-right: auto !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .lead,
        p,
        span {
            font-weight: 300;
            line-height: 1.7;
        }

        p {
            font-size: 1rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body style="min-width: 600px">
    <section>
        <div class="mx-auto mt-5">
            <div class="card card-invoice">
                <div class="card-header text-center">
                    <div class="row">
                        <div class="col-md-4 text-left mr-auto">
                            <img class="mb-2 w-100" src="https://www.fvn.com.co/img/FVN/logo.png" alt="feel-very-nice"
                                style=" max-width: 110px; ">
                            <h6>
                                Feels Very Nice, Cl. 10 #15 - 94, Pereira, Risaralda
                            </h6>
                            <p class="d-block text-muted">Tel: +57 311 7192436</p>
                        </div>
                        <div class="col-lg-3 col-md-5 text-left mt-3 ml-auto">
                            <h4 class="mb-1">Enviado a:</h4>
                            <p class="d-block">{{$customer->name}} {{$customer->last_name}}</p>
                            <h6>
                                {{$order->address->customer_address}}, {{$order->address->city->city}}
                            </h6>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4 mr-auto">
                            <h3 class="mt-3 text-left">Orden N° <br><small class="mr-2">FVNO-{{$order->id}}</small>
                            </h3>
                        </div>
                        <div class="col-lg-4 col-md-5 ml-auto">
                            <div class="row mt-5">
                                <div class="col-md-6">Fecha de la orden:</div>
                                <div class="col-md-6">{{$order->created_at->format('M d, Y h:i a')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table-striped table text-center">
                                    <thead class="bg-default">
                                        <tr>
                                            <th scope="col" class="text-center text-white">SKU</th>
                                            <th scope="col" class="text-center text-white">Nompre Producto</th>
                                            <th scope="col" class="text-center text-white">Descripción</th>
                                            <th scope="col" class="text-center text-white">Cantidad</th>
                                            <th scope="col" class="text-center text-white">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->sku}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>
                                                @php
                                                $pattr =
                                                \Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute::find($product->pivot->product_attribute_id)
                                                @endphp
                                                @if(!is_null($pattr))<br>
                                                @foreach($pattr->attributesValues as $it)
                                                <p class="label label-primary mb-1">{{ $it->attribute->name }} :
                                                    {{ $it->value }}</p>
                                                @endforeach
                                                @endif

                                            </td>
                                            <td>{{$product->pivot->quantity}}</td>
                                            <td>{{config('cart.currency')}}
                                                @if ($product->sale_price)
                                                {{number_format($product->sale_price * $product->pivot->quantity, 2)}}
                                                @else
                                                {{number_format($product->price * $product->pivot->quantity, 2)}}
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class=" text-right h4">Subtotal <br><br>Envío <br><br>
                                                Descuentos
                                                <br><br>Impuestos <br><br>
                                                Total </th>
                                            <th class="text-right h4">{{config('cart.currency')}}
                                                {{number_format($order->sub_total, 2)}} <br><br>
                                                {{config('cart.currency')}} {{number_format($order->total_shipping, 2)}}
                                                <br><br>
                                                {{config('cart.currency')}} {{number_format($order->discounts, 2)}}
                                                <br><br>
                                                {{config('cart.currency')}} {{number_format($order->tax, 2)}} <br><br>
                                                <strong>{{config('cart.currency')}}
                                                    {{number_format($order->grand_total, 2)}}</strong> </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="col-md-5 ml-auto">
                        <h5>¡Gracias!</h5>
                        <p class="description">Si encuentra algún problema relacionado con la orden, puede contactarnos
                            en:
                        </p>
                        <h6 class="d-block">
                            email:
                            <small class="text-muted">gerencia@fvn.com.co</small>
                        </h6>

                    </div>
                    <div class="w-100">
                        <br>
                        <p class="description">Recuerde que si su metodo de pago es <b>BALOTO</b> debe de hacer una
                            consignación a la cuenta de ahorros Colpatria <b>#5782004631</b> a nombre de Emilia Estrada.
                        </p>
                        <p class="description">O si su metodo de pago es <b>EFECTY O GANA</b> debe de realisar un giro a
                            nombre de Juliana Jaramillo <b>CC 42.138.544</b> Pereira.
                        </p>
                        <p class="description">Y enviar el correspondiente comprobante de pago al Wharsapp 3117192436
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
