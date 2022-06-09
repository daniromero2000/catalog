@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/front/information/app.min.css') }}">
    <style>
        article h2 {
            margin-top: 0%;
        }

        #collapseOne img {
            width: 15%;
            margin: auto;
        }

        #collapseTwo img {
            width: 15%;
            margin: auto;
            margin-top: 2%;
        }

         #collapseThree img {
            width: 15%;
            margin: auto;
            margin-top: 2%;
        }

          #collapseFour img {
            width: 20%;
            margin: auto;
        }

    </style>
@endsection
@section('content')
    <article>
        <h1>MÉTODOS DE PAGO</h1>
        <section>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header bg-white" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                1. TRANSFERENCIA BANCOLOMBIA APP
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Podrás pagar en efectivo en corresponsal bancario (no en banco) o trasferencia a Cta Ahorros
                            Bancolombia No. 85200041360, escanea el código e ingresa directo
                            <div class="w-100">
                                <img src="{{ asset('img/cards/logo-bancolombia.png') }}" alt="bancolombia">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                2. PAGO EN LÍNEA
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Podrás pagar con tu tarjeta bancaria Visa, MasterCard y American Express) a través de PSE.
                            <div class="w-100">
                                <img src="{{ asset('img/cards/list-cards.jpg') }}" alt="cards">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                3. PAGO EN EFECTIVO
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Podrás pagar en efectivo en Baloto Consignando a cuenta Ahorros Colpatria # 5782004631 a nombre
                            de Emilia Estrada servicio Gratuito.
                            Recuerda que tu pago cuenta con una vigencia de hasta 1 día.
                            Para evitar complicaciones, te sugerimos hacer tu pago lo antes posible y no esperar a la fecha
                            de vencimiento.
                            <div class="w-100">
                                <img src="{{ asset('img/cards/baloto.png') }}" alt="baloto">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                4. DAVIPLATA
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            Podrás pagar en por DAVIPLATA transfiriendo a la cuenta No. 3117192436

                            Recuerda que tu l pago cuenta con una vigencia de hasta 1 día.
                            Para evitar complicaciones, te sugerimos hacer tu pago lo antes posible y no esperar a la fecha
                            de vencimiento.

                            <div class="w-100">
                                <img src="{{ asset('img/cards/daviplata.png') }}" alt="daviplata">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ma-b">
            </div>
        </section>
    </article>
@endsection
