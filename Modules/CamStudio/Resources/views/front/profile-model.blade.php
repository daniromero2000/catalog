@extends('layouts.front.app')
@section('styles')
<style>
    .bg-about-me {
        background-image: url('/img/lfc/background_aboutme.png');
        background-size: cover;
        margin-top: -55%;
    }

    .bg-model-banner {
        background-image: url('/img/lfc/model-banner.png');
        background-size: cover;
        height: 800px;
        border-top: solid 1px #AF6AAB;
        border-bottom: solid 1px #AF6AA4;
    }

    @media (max-width: 767px) and (min-width: 1px) {
        .bg-model-banner {
            background-image: none;
            background-size: cover;
            height: 100%;
            border-top: solid 1px #AF6AAB;
            border-bottom: solid 1px #AF6AA4;
            background-color: #222222;
        }

        .img-model-responsive {
            width: 75%;
            border-radius: 60%;
            border: solid 4px #AF6AA4;
        }
    }

    @media (max-width: 969px) and (min-width: 700px) {
        .bg-about-me {
            background-image: url(/img/lfc/background_aboutme.png);
            background-size: cover;
            margin-top: -40%;
        }
    }

    @media (max-width: 1500px) and (min-width: 1300px) {
        .bg-model-banner {
            background-image: url(/img/lfc/model-banner.png);
            background-size: cover;
            height: 100%;
            border-top: solid 1px #AF6AAB;
            border-bottom: solid 1px #AF6AA4;
        }

        .img-model-responsive {
            width: 0%;
            border-radius: 0%;
            border: none;
            display: none;
        }
    }

    @media (max-width: 2500px) and (min-width: 1500px) {
        .bg-model-banner {
            background-image: url(/img/lfc/model-banner.png);
            background-size: cover;
            height: 100%;
            border-top: solid 1px #AF6AAB;
            border-bottom: solid 1px #AF6AA4;
        }

        .img-model-responsive {
            width: 0%;
            border-radius: 0%;
            border: none;
            display: none;
        }
    }

    @media (max-width: 1299px) and (min-width: 767px) {
        .bg-model-banner {
            background-image: url(/img/lfc/model-banner.png);
            background-size: cover;
            height: 100%;
            border-top: solid 1px #AF6AAB;
            border-bottom: solid 1px #AF6AA4;
        }

        .img-model-responsive {
            width: 0%;
            border-radius: 0%;
            border: none;
            display: none;
        }
    }

    @media (max-width: 699px) and (min-width: 500px) {
        .bg-about-me {
            background-image: url(/img/lfc/background_aboutme.png);
            background-size: cover;
            margin-top: -40%;
        }
    }

    @media (max-width: 350px) and (min-width: 300px) {
        .bg-about-me {
            background-image: url(/img/lfc/background_aboutme.png);
            background-size: cover;
            margin-top: -120%;
        }
    }

    @media (max-width: 400px) and (min-width: 351px) {
        .bg-about-me {
            background-image: url(/img/lfc/background_aboutme.png);
            background-size: cover;
            margin-top: -92%;
        }
    }

    @media (max-width: 450px) and (min-width: 401px) {
        .bg-about-me {
            background-image: url(/img/lfc/background_aboutme.png);
            background-size: cover;
            margin-top: -80%;
        }
    }
</style>
@endsection
@section('content')
<div class="m-auto text-center fixed-float-model">
    <div class="py-4">
        <a target="_blank" href="">
            <img class="w-float-model" src="{{ asset('img/lfc/float.png') }}" alt="Instagram LefemmeCams">
        </a>
    </div>
</div>
<nav class="navbar navbar-expand-lg bg-lfc-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <i style="font-size: 30px;" class="fas fa-bars color-i"></i>
    </button>
    <div class="m-auto">
        <a class="navbar-brand" href="/"><img class="w-logo" src="{{ asset('img/logos/logo.png') }}"
                alt="Logo LeFemmeCams">
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <div class="w-100">
            <div class="row row-reset text-center m-nav-rp">
                <div class="nav-m-a">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-center">
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href="/"><span class="items-nav-model border-item-nav"><i
                                        class="fas fa-female  items-icon-nav"></i> PROFILE</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href=""><span class="items-nav-model"><i
                                        class="fas fa-images items-icon-nav"></i> PHOTOS</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href=""><span class="items-nav-model"><i
                                        class="fas fa-video items-icon-nav"></i> VIDEOS</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href="/"><span class="items-nav-model"><i
                                        class="fas fa-users items-icon-nav"></i> FANSCLUB</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href=""><span class="items-nav-model"><i
                                        class="fas fa-share-alt-square items-icon-nav"></i> SOCIAL</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href=""><span class="items-nav-model"><i
                                        class="fas fa-gift items-icon-nav"></i> GIFTS</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href="/"><span class="items-nav-model"><i
                                        class="fas fa-info-circle items-icon-nav"></i> DATES</span></a>
                        </li>
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                            <a class="navtext" href=""><span class="items-nav-model"><i
                                        class="fas fa-comments items-icon-nav"></i> COMMENTS</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="row row-reset bg-lfc-dark">
    <div class="col-6 col-md-6">
        <div class="row row-reset content-row-model">
            <div class="row row-reset">
                <div class="col-12 text-revert">
                    <h1 class="name-model text-uppercase">{{ $camModel->nickname }}</h1>
                    <h1 class="hashtag-model">#SWEETCARAMEL</h1>
                    <h1 class="follow-me-model"><i class="fas fa-heart"></i> FOLLOW ME</h1>
                    <div class="content-specific-model">
                        <h1 class="item-specific">AGE: {{ $camModel->fake_age }}</h1>
                        <h1 class="item-specific">WEIGHT:  {{ $camModel->weight }}</h1>
                        <h1 class="item-specific">BUBS: {{ $camModel->breast_cup_size }}</h1>
                        <h1 class="item-specific text-uppercase">COUNTRY: {{ $camModel->employee->subsidiary->city->province->country->name}}</strong></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <img class="w-100 bg-nav-model-mt" src="{{ asset('img/lfc/background-nav.png') }}" alt="">
        <img class="w-100-model img-profile-model" src="{{ asset("storage/$camModel->cover") }}">
    </div>
</div>
<div class="row row-reset bg-lfc-dark">
    <div class="col-12 col-md-12 content-about-me bg-about-me">
        <h1 class="text-about-me">ABOUT ME</h1>
    </div>
</div>
<div class="row row-reset bg-lfc-dark content-description-about">
    <div class="col-12 col-md-12">
        <h1 class="text-description-about text-uppercase">
            {{ $camModel->likes_dislikes }}
        </h1>
    </div>
</div>
<div class="row row-reset bg-model-banner">
    <div class="col-12 col-md-6 m-auto text-center m-auto">
        <div style="margin-top: 20px;">
            <h2 class="text-personalize">PERSONALIZE</h2>
            <h2 class="text-your-hot">YOUR HOT</h2>
            <h2 class="text-experience">EXPERIENCE</h2>
            <h2 class="text-withme">WITH ME</h2>
            <a class="btn-available-now" href="">AVAILABLE NOW</a>
        </div>
    </div>
    <div class="col-12 col-md-6 m-auto text-center">
        <img class="img-model-responsive" src="{{ asset('img/lfc/model-banner.jpg') }}" alt="Gallery image 2">
    </div>
</div>
<div class="row row-reset bg-lfc-dark">
    <div class="col-12 col-md-12">
        <div class="container">
            <div class="gallery m-grid-packs">

                @foreach ($camModel->images as $image)
                    <figure class="gallery__item gallery__item--2">
                        <img src="{{ asset($image->src) }}" alt="Gallery image 2" class="gallery__img">
                    </figure>
                @endforeach
                <figure class="gallery__item gallery__item--2">
                    <img src="{{ asset('img/lfc/pack1.png') }}" alt="Gallery image 2" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--3">
                    <div class="text-center position-content-lock">
                        <img src="{{ asset('img/lfc/security.png') }}" class="lock-pack">
                        <br>
                        <a class="btn-unlock-pack" href="">UNLOCK ALBUM</a>
                    </div>
                    <img src="{{ asset('img/lfc/background2.png') }}" alt="Gallery image 3" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--4">
                    <img src="{{ asset('img/lfc/pack2.png') }}" alt="Gallery image 4" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--5">
                    <img src="{{ asset('img/lfc/pack3.png') }}" alt="Gallery image 5" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--6">
                    <img src="{{ asset('img/lfc/pack4.png') }}" alt="Gallery image 6" class="gallery__img">
                </figure>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-style-model mt-auto p-4">
    <section class="container-footer mx-auto">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-2 col-xl-3 d-flex justify-content-center m-auto">
                <img src="{{ asset('img/logos/logo.png')}}" class="logo-footer pr-xl-5 lazy" alt="tws-footer">
            </div>
            <div class="col-sm-6 justify-content-center d-flex col-lg-3 col-xl-2">
                <ol class="text-white pl-0 pl-xl-2 footer-responsive">
                    <li><b>HOME</b></li>
                    <li>MODELS</li>
                    <li>PACKS</li>
                </ol>
            </div>
            <div class="col-sm-6 justify-content-center d-flex col-lg-3 col-xl-3">
                <ol class="text-white pl-0 pl-xl-5 footer-responsive">
                    <li><b>SERVICIO AL CLIENTE</b></li>
                    <li class="li-width">POLITICA DE TRATAMIENTO DE DATOS</li>
                    <li>MÉTODOS DE PAGO</li>
                    <li>METODO DE ENTREGA</li>
                </ol>
            </div>
            <div class="col-12 col-lg-3 col-xl-3 pl-0 pr-xl-5 text-center">
                <h5 class="text-white contact-footer"><b>CONTÁCTANOS</b></h5>
                <ol class="pl-0">
                    <li class="color-clear"><b>311 7192436</b></li>
                </ol>
            </div>
            <div class="col-12 col-lg-1 col-xl-1 text-center d-flex my-auto">
                <div class="row mx-auto">
                    <div class="row">
                        <div class="col-3 col-lg-12">
                            <a href="#" target="_blank">
                                <img src="{{ asset('img/lfc/facebook.png')}}" class="icon-footer lazy" alt="facebook">
                            </a>
                        </div>
                        <div class="col-3 col-lg-12">
                            <a href="#" target="_blank">
                                <img src="{{ asset('img/lfc/instagram.png')}}" class="icon-footer lazy" alt="instagram">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</footer>
<section class="footer-copyright">
    <div class="container-footer mx-auto ">
        <div class="row mx-0 text-center">
            <i class="mx-auto my-2"><small>Copyright ©2020 All rights reserved | powered by <b>
                        SmartCommerce</b>.</small></i>
        </div>
    </div>
</section>

@endsection
