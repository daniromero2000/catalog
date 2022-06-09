<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Card -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link href="http://fvn.com.co/" rel="canonical" />
    <link rel="icon" href="{{ asset('img/FVN/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front/whatsapp.min.css') }}">

    <style>
        .font {
            font-family: 'Pluto Cond'
        }

        .content-header {
            font-weight: 400;
            font-style: normal;
            padding: 6px;
            background: #002e54;
            display: flex;
            margin-top: 3%
        }

        .img-logo {
            position: absolute;
            width: 224px;
            top: 0
        }

        .thank-you {
            font-weight: 700;
            color: #f0e437;
            font-size: 60px;
            margin-left: auto;
            margin-right: auto
        }

        .orden {
            color: #edc748;
            font-size: 25px;
            font-weight: 700
        }

        .text-orden {
            font-size: 20px
        }

        @media only screen and (min-width:701px) and (max-width:980px) {
            .img-logo {
                position: absolute;
                width: 152px;
                top: -5px
            }

            .thank-you {
                font-weight: 700;
                color: #f0e437;
                font-size: 40px;
                margin-left: auto;
                margin-right: auto
            }

            .orden {
                color: #edc748;
                font-size: 20px;
                font-weight: 700
            }

            .text-orden {
                font-size: 15px
            }
        }

        @media only screen and (min-width:701px) and (max-width:980px) {
            .img-logo {
                position: absolute;
                width: 152px;
                top: -5px
            }

            .thank-you {
                font-weight: 700;
                color: #f0e437;
                font-size: 40px;
                margin-left: auto;
                margin-right: auto
            }

            .orden {
                color: #edc748;
                font-size: 20px;
                font-weight: 700
            }

            .text-orden {
                font-size: 15px
            }
        }

        @media only screen and (min-width:501px) and (max-width:700px) {
            .img-logo {
                position: absolute;
                width: 131px;
                top: -5px
            }

            .thank-you {
                font-weight: 700;
                color: #f0e437;
                font-size: 31px;
                margin-left: auto;
                margin-right: auto
            }

            .orden {
                color: #edc748;
                font-size: 19px;
                font-weight: 700
            }

            .text-orden {
                font-size: 15px
            }
        }

        @media only screen and (min-width:389px) and (max-width:500px) {
            .img-logo {
                position: absolute;
                width: 114px;
                top: -5px
            }

            .thank-you {
                font-weight: 700;
                color: #f0e437;
                font-size: 29px;
                margin-left: auto;
                margin-right: auto
            }

            .orden {
                color: #edc748;
                font-size: 19px;
                font-weight: 700
            }

            .text-orden {
                font-size: 15px
            }
        }

        @media only screen and (min-width:300px) and (max-width:388px) {
            .img-logo {
                position: absolute;
                width: 93px;
                top: 7px
            }

            .thank-you {
                font-weight: 700;
                color: #f0e437;
                font-size: 23px;
                margin-left: auto;
                margin-right: auto
            }

            .orden {
                color: #edc748;
                font-size: 16px;
                font-weight: 700
            }

            .text-orden {
                font-size: 13px
            }
        }

    </style>
</head>

<body>
    <section>
        <div class="w-100 font">
            <div class="container-reset row content-header">
                {{-- <a href="/" class="w-100" style=" z-index: 99999; "><img
                        class="img-logo" src="{{ asset('img/FVN/logo.png') }}" alt="feels-very-nice"></a>
                --}}
                <div class="col-3 col-sm-1"></div>
                <div class="col-9 col-sm-11 text-center">
                    <h2 class="thank-you">¡Gracias
                        por tu compra!</h2>
                </div>
            </div>
            @if ($order->order_status_id == 1 || $order->order_status_id == 5)
                <div class="container d-flex mt-4">
                    <div class="ml-auto">
                        <h3 class="orden">ORDEN N°: TKN-{{ $order }}</h3>
                    </div>
                </div>
            @endif
            <div class="container mt-3">
                @if ($order->order_status_id == 1 || $order->order_status_id == 5)
                    <p class="text-center text-orden">
                        <span> Hola {{ $customer }},</span>
                        <br>
                        <span><b>Gracias por comprar en TKN online</b></span>
                        <br>
                        <span>
                            Tu pedido ha sido creado con el número TKN-{{ $order }} exitosamente en nuestro sistema de
                            información.
                        </span>
                        <br>
                        <span>Nuestra promesa de entrega es de 3 a 7 días hábiles contados a partir del dia hábil
                            después de realizar
                            tu pedido.</span>

                        <br>
                    </p>
                @elseif($order->order_status_id == 3)
                    <p class="text-center text-orden">
                        <span> Hola {{ $customer }},</span>
                        <br>
                        <span>
                            Lastimosamente tu Transacción ha sido rechazada.
                        </span>
                    </p>
                @endif
                <hr class="mt-4" style="border-top: 2px solid rgb(0 46 84 / 69%);">

                <div class="banner_text w-100 text-center">
                    <div class="banner_text_iner text-center">
                        <h2>Resumen Transacción</h2>
                        <ul style=" list-style: none; padding: 0px; ">
                            <li><b>Empresa: </b> Tukan</li>
                            <li><b>Fecha: </b> {{ date('Y-m-d H:i:s') }} </li>
                            @if ($data->estado)
                                <li><b>Estado de la transaccion:</b> {{ 'Transaccion' . ' ' . $data->estado }} </li>
                            @endif
                            @if ($data->ref_payco)
                                <li><b>Referencia de la transaccion:</b> {{ $data->ref_payco }} </li>
                            @endif
                            @if ($data->valor)
                                @if ($data->banco != null)
                                    <li><b>Banco:</b> {{ $data->banco }} </li>
                                @endif
                            @endif
                            @if ($data->valor)
                                <li><b>Valor total: </b>${{ number_format($data->valor) }} </li>
                            @endif
                            @if ($data->moneda)
                                <li><b>Moneda: </b> {{ $data->moneda }} </li>
                            @endif
                            @if ($data->respuesta)
                                <li><b>Descripción: {{ $data->respuesta }} </b> </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-reset text-center">
            <a class="btn btn-primary mx-auto" style=" background-color: #edc748; border-color: #edc748 ; " href="/">Ver
                mas productos</a>
        </div>
    </section>
</body>
<script src="{{ asset('js/front/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>

</html>
