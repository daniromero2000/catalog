@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/front/information/app.min.css') }}">
    <style>
        section img {
            width: 15%;
        }
    </style>
@endsection
@section('content')
    <article>
        <h1>METODO DE ENTREGA</h1>
        <section>
            <p>
                Todos nuestros pedidos son enviados en un plazo de dos días hábiles después de haber recibido el pago.
                Nuestro horario de envío de las órdenes es de lunes a viernes, No se realizan envíos los fines de semana.
            </p>
            <h2>Nuestras transportadoras aliadas son:</h2>
            <div class="w-100 d-flex">
                <img class="ml-auto mr-4" src="{{ asset('img/cards/rapidisimo.png') }}" alt="rapidisimo">
                <img class="mr-auto" src="{{ asset('img/cards/envia.png') }}" alt="envia">

            </div>
            <p class="mt-4">El tiempo de entrega promedio es de 2 a 7 días hábiles después entrega al servicio de envíos.</p>
            <div class="ma-b">
            </div>
        </section>
    </article>
@endsection
