@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/front/information/app.min.css') }}">
@endsection
@section('content')
    <article>
        <section>
            <h2>NUESTRA EMPRESA</h2>
            <p>
                Feels Very Nice es una empresa colombiana, ubicada en la Ciudad de Pereira que nació en el año 2010 y desde
                entonces ha marcado tendencia en innovar y fabricar calzado infantil fisiológico, gracias a eso ha logrado
                posicionarse en distintos mercados con su línea de calzado infantil que busca cuidar la pisada de los niños,
                para su correcta formación y así evitar riesgos a futuro.
            </p>

            <div class="first-container">
                <img src="{{ asset('img/informations/company/imagen1.jpg') }}">
            </div>

            <h2>CENTRO DE DISTRIBUCION </h2>

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="8000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen2.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen3.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen4.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen5.jpg') }}" alt="imagen">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <h2>DISEÑO Y DESARROLLO </h2>

            <div id="carouselDeveloper" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselDeveloper" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselDeveloper" data-slide-to="1"></li>
                    <li data-target="#carouselDeveloper" data-slide-to="2"></li>
                    <li data-target="#carouselDeveloper" data-slide-to="3"></li>
                    <li data-target="#carouselDeveloper" data-slide-to="4"></li>
                    <li data-target="#carouselDeveloper" data-slide-to="5"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="8000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen6.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen7.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen8.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen9.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen10.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen11.jpg') }}" alt="imagen">
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselDeveloper" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselDeveloper" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <h2>PLANTA DE PRODUCCIÓN</h2>

            <div id="carouselProduction" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselProduction" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselProduction" data-slide-to="1"></li>
                    <li data-target="#carouselProduction" data-slide-to="2"></li>
                    <li data-target="#carouselProduction" data-slide-to="3"></li>
                    <li data-target="#carouselProduction" data-slide-to="4"></li>
                    <li data-target="#carouselProduction" data-slide-to="5"></li>
                    <li data-target="#carouselProduction" data-slide-to="6"></li>
                    <li data-target="#carouselProduction" data-slide-to="7"></li>
                    <li data-target="#carouselProduction" data-slide-to="8"></li>
                    <li data-target="#carouselProduction" data-slide-to="9"></li>
                    <li data-target="#carouselProduction" data-slide-to="10"></li>
                    <li data-target="#carouselProduction" data-slide-to="11"></li>
                    <li data-target="#carouselProduction" data-slide-to="12"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="8000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen13.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen14.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen15.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen16.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen17.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen18.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen19.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen20.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen21.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen22.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen23.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen24.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen25.jpg') }}" alt="imagen">
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselProduction" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselProduction" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <h2>SHOW ROOM</h2>
            
            <div id="carouselShow" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselShow" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselShow" data-slide-to="1"></li>
                    <li data-target="#carouselShow" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="8000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen26.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen27.jpg') }}" alt="imagen">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img class="w-100" src="{{ asset('img/informations/company/imagen28.jpg') }}" alt="imagen">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselShow" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselShow" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>

        <div class="ma-b">
        </div>
    </article>
@endsection
