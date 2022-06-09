<!doctype html>
<html lang="en es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('name-pagine') Dashboard cliente, {{ config('app.name') }}</title>
    <link rel="icon" href="{{asset('modules/generals/argonTemplate/img/icons/icon.png')}}" type="image/png">
    @yield('icon')
    @include('layouts.front.app.metadata.config')
    <!--  Meta business identity tags -->
    @include('layouts.front.app.metadata.identity')
    <!--  Meta OG business identity tags -->
    @include('layouts.front.app.metadata.og')
    <!-- Social meta tags -->
    @include('layouts.front.app.metadata.social')
    @yield('og')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main/dashboard.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    @yield('styles')
</head>

<body>
    @include('xisfopay::front.customers.accounts.layouts.sidenav')
    <div class="main-content" id="panel">
        @include('xisfopay::front.customers.accounts.layouts.nav')
        <div class="header bg-primary">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4 pb-6">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a class="btn-breadcum-home" href="{{ route('account.dashboard') }}"> Inicio <i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('breadcum-item')</li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('breadcum-item-one')
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @yield('content')
            </div>
            @include('xisfopay::front.customers.accounts.layouts.footer')
        </div>
    </div>
    <script src="{{asset('js/dashboard/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/dashboard/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/dashboard/cookies/js.cookie.js')}}"></script>
    <script src="{{asset('js/dashboard/scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('js/dashboard/scrollLock/scrollLock.min.js')}}"></script>
    <!-- Optional JS -->
    <script src="{{asset('js/dashboard/Chart/Chart.min.js')}}"></script>
    <script src="{{asset('js/dashboard/ChartExtension/Chart.extension.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{asset('js/dashboard/argon/argon.js')}}"></script>
    @yield('scripts')
</body>

</html>
