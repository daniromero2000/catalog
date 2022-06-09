@extends('generals::layouts.admin.app')
@section('styles')
@include('camstudio::admin.layouts.cammodels.showCSS')
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/admin/carousel.js')}}"></script>
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.cammodels.index') }}">Modelos</a>
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
    <div class="header pb-6 d-flex align-items-end"
        style="min-height: 500px; background-image: url({{asset('modules/generals/argonTemplate/img/theme/profile-cover.jpg')}}); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row w-100">
                <div class="col-xl-5 col-lg-5 text-center mb-4">
                    <h3 class="display-3 text-danger">Hola, {{ $cammodel->nickname }}</h3>
                    <p class="text-white mb-2">Administra tu perfil como modelo Lefemme
                        <br> Cams. Aquí puede editar toda tu información</p>
                    @if ($projectUrl != 'www.lefemme.com.co')
                        <a href="{{ route('front.model.slug', ['slug' => $cammodel->slug]) }}"
                            class="btn btn-danger btn-sm rounded-pill px-5" target="_blank">Ver perfil publicado</a>
                    @endif
                </div>
                <div class="col-xl-7 col-lg-7 text-center mb-4">
                    <div>
                        @foreach ($cammodel->cammodelStreamAccounts as $streamAccount)
                        @if ($streamAccount->streaming->id != 20)
                        <a target="_blank"
                            href="https://{{ $streamAccount->streaming->url }}{{ $streamAccount->profile }}"
                            style="height: 50px; width: 50px; border-radius: 50%; overflow: hidden;">
                            <img src="{{ asset("storage/".$streamAccount->streaming->icon) }}"
                                style="max-height: 50px; max-width: 50px; border-radius: 50%; border: 2px solid #666666;"
                                alt="{{$streamAccount->streaming->icon}}" class="img-fluid mx-auto">
                        </a>
                        @endif
                        @endforeach
                    </div>
                    <div class="mt-4">
                        @foreach ($cammodel->cammodelSocialMedia as $socialAccount)
                        <a class="btn rounded-pill px-0" target="_blank"
                            href="https://{{ $socialAccount->socialMedia->url }}/{{ $socialAccount->profile }}"
                            style="height: 50px; width: 50px; background: #ffffff">
                            <span><i class="{{ $socialAccount->socialMedia->icon }} fa-2x"
                                    style="color: #1DA1F2;"></i></span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.cammodels.update', $cammodel->id) }}" method="post" class="form"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="container-fluid mt--6">
            <div class="card px-3">
                <div class="row">
                    <div class="col 12 col-md-12">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="request-tab" data-toggle="tab"
                                        href="#profile" role="tab" aria-controls="request"
                                        aria-selected="true">Información de Perfil</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="document-tab" data-toggle="tab"
                                        href="#streaming" role="tab" aria-controls="home"
                                        aria-selected="false">Streamings & Socials</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="document-tab" data-toggle="tab"
                                        href="#properties" role="tab" aria-controls="home"
                                        aria-selected="false">Propiedades y seguimiento</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" style="background: none;" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <div class="row pr-2">
                            @include('camstudio::admin.layouts.cammodels.edit_profile')
                            @include('camstudio::admin.layouts.cammodels.images')
                        </div>
                    </div>
                    <div class="tab-pane fade" style="background: none;" id="streaming" role="tabpanel"
                        aria-labelledby="streaming-tab">
                        @include('camstudio::admin.layouts.cammodels.streamings_and_socials')
                    </div>
                    <div class="tab-pane fade" style="background: none;" id="properties" role="tabpanel"
                        aria-labelledby="properties-tab">
                        @include('camstudio::admin.layouts.cammodels.properties')
                    </div>
                </div>
            </div>
            <div class="py-2 text-right">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </div>
    </form>
    @include('camstudio::admin.layouts.cammodels.add_banned_country')
    @include('camstudio::admin.layouts.cammodels.add_comment_modal')
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>
@include('camstudio::admin.layouts.cammodels.showJS')
@include('camstudio::admin.layouts.cammodels.validate')
@endsection
