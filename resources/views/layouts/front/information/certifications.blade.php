@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/front/information/app.min.css') }}">
@endsection
@section('content')
    <article class="content-empty">
        <h1>CERTIFICACIONES</h1>
        <section>
            <p>
              Nuestra línea fisiológica posee certificación de producto libres de plomo, cadmio y metales pesados lo cual lo hace calzado seguro para los niños, además una de las bases estratégicas de Feels Very Nice se fundamenta en la utilización de PVC como materia prima que permite crear las formas orgánicas características de los zapatos. A su vez, dicho material brinda atributos a los productos, como al ser a prueba de agua, ser duraderos y tener un olor característico a goma de mascar que a los niños les encanta.
            </p>

            <img class="mx-auto w-100 mt-4" src="{{ asset('img/banners/certificaciones.png') }}" alt="certificaciones">
            <div class="ma-b">
            </div>
        </section>
    </article>
@endsection
