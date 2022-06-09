<style>
    .buton-login-modal {
        background-color: #4F98B9;
        border-color: #4F98B9;
        color: white;
    }

    .buton-login-modal:hover {
        background-color: #B93D6B;
        border-color: #B93D6B;
        color: white;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-blue-page">
    <div class="text-white mx-auto container-reset text-center relative">
        ENVÍOS A TODO COLOMBIA <img src="{{ asset('img/FVN/logo-colombia.svg') }}" class="logo-send" alt="colombia">
        <div class="absolute social-icon-header">
            <img src="{{ asset('img/FVN/facebook.png') }}" alt="facebook"
                onclick="reloadUrl('https://www.facebook.com/feelsverynice/',2)" style="cursor: pointer">
            <img src="{{ asset('img/FVN/instagram.png') }}" alt="instagram"
                onclick="reloadUrl('https://www.instagram.com/feelsverynice/',2)" style="cursor: pointer">
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light p-2 bg-light py-lg-2 py-sm-3">
    <div class="container-reset container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand container-logo" href="/"><img class="logo" src="{{ asset('img/FVN/logo.png') }}"
                alt="logo_fvn"></a>
        <div class="collapse navbar-collapse mt-4 mt-lg-0 ml-lg-5" id="navbarToggler">
            <div class="content-link">
                <ul class="navbar-nav pr-lg-5 mr-xl-5 ml-auto justify-content-between mt-2 mt-lg-0 content-headers">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('/') }}">HOME</a>
                    </li>
                    @include('ecommerce::front.categories.layouts.navs.category_nav_option_one')
                    <li class="nav-item">
                        <a class="nav-link" href="/outlet" style=" color: #dc467b; "><b>OUTLET</b></a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <div class="search">
                    <input type="text" name="" style=" max-height: 100%; " placeholder="Buscar" class="text">
                    <button type="submit" class="btn-search"><i class="fa fa-search "></i></button>
                </div>
            </form>
        </div>
        <div class="text-center ml-auto">
            <li class="nav-item dropdown" id="cart" style=" list-style: none; ">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div>
                        <div id="container">
                            <div class="relative position-cart">
                                <img src="{{ asset('img/FVN/cart.png') }}" class="cart-icon" alt="logo cart">
                                <div class="item" id="items" style="display: none">
                                    <span class="badge text-white navbar-badge badge-count" id="total">0</span>
                                    <div class="circle" style="animation-delay: -3s"></div>
                                    <div class="circle" style="animation-delay: -2s"></div>
                                    <div class="circle" style="animation-delay: -1s"></div>
                                    <div class="circle" style="animation-delay: 0s"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;"
                    id="cartItems">
                </div>
            </li>
        </div>
        {{-- Inicio dropdown--}}
        {{-- <a href="/cart" class="dropdown-item">
            <div class="media">
                <div class="media-body d-flex justify-content-between px-4 py-2">
                    <p class="text-sm subtotal">Subtotal</p>
                    <p class="text-sm text-muted price"></p>
                </div>
            </div>
        </a>
        <div class="dropdown-divider">

        </div>
        <div class="dropdown-item dropdown-footer">
            <div class="px-3">
                <a href="/cart" class="btn button-reset d-block">Ir al carrito</a>
            </div>
        </div>' : '
        <a href="#" class="dropdown-item dropdown-footer">Tu lista está vacía </a>
        <div class="dropdown-item dropdown-footer">
            <div class="px-3">
                <a href="/cart" class="btn button-reset d-block">Ir al carrito</a>
            </div>
        </div> --}}
        {{-- Fin --}}
        <div class="">
            <li class="nav-item dropdown" id="wishlist" style=" list-style: none; ">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div>
                        <div id="container">
                            <div class="relative position-cart">
                                <img src="{{ asset('img/FVN/wishlist.png') }}" alt="wishlist" style=" width: 32px;">
                                <div class="item-wishlist" id="wishlistContainer" style="display: none">
                                    <span class="badge text-white navbar-badge badge-count-wishlist"
                                        id="totalWishlist">0</span>
                                    <div class="circle-wishlist" style="animation-delay: -3s"></div>
                                    <div class="circle-wishlist" style="animation-delay: -2s"></div>
                                    <div class="circle-wishlist" style="animation-delay: -1s"></div>
                                    <div class="circle-wishlist" style="animation-delay: 0s"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit;"
                    id="wishlistItems">
                </div>
            </li>
        </div>
        <div class="text-center d-flex">
            <li class="nav-item my-auto" id="" style=" list-style: none; ">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a class="nav-link account px-4" href="{{ route('accounts') }}">
                        <b> {{auth()->user()->name}} <i class="fas fa-user"></i></b>
                    </a>
                    {{-- <a class="nav-link account px-4" href="logout">
                    <b> LOGOUT <i class="fas fa-sign-out-alt"></i></b>
                </a> --}}
                    @else
                    <a class="nav-link account px-4" href="" data-toggle="modal" data-target="#loginModal">
                        <span class="hidden-text-header"><b> INICIAR SESIÓN </b></span>
                        <i class="fas fa-user"></i>
                    </a>
                    @if (Route::has('register'))
                    {{-- <a class="nav-link account px-4" href="{{ route('register') }}">
                    <b> REGISTER <i class="fas fa-plus-circle"></i></b>
                    </a> --}}
                    @endif
                    @endauth
                </div>
                @endif
            </li>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-rounded">
                <div class="modal-body">
                    <div class="row pb-4">
                        <div class="col-12 mb-2">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-md-12">@include('generals::layouts.errors-and-messages')</div>
                        <div class="row m-auto">
                            <div class="col-12">
                                <img style="width: 100px;" src="{{ asset('img/FVN/logo.png') }}" class=""
                                    alt="user login">
                            </div>
                        </div>
                        <div class="col-12 text-center mb-3">
                            <h2 style=" font-size: 20px; color: gray; ">Inicia sesión
                            </h2>
                        </div>
                        <div class="col-10 mx-auto">
                            <form action="{{ route('login') }}" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="email" class="control-label" style="color: gray;">Email</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i style="color: #4F98B9"
                                                    class="fas fa-at"></i></div>
                                        </div>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="su@correo.com" autofocus>
                                    </div>
                                    {{-- <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="su@correo.com" autofocus> --}}
                                </div>
                                <div class="form-group">
                                    <label for="password" style="color: gray;">Contraseña</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i style="color: #4F98B9"
                                                    class="fas fa-key"></i></div>
                                        </div>
                                        <input type="password" name="password" id="password" value=""
                                            class="form-control" placeholder="****">
                                    </div>
                                    {{-- <input type="password" name="password" id="password" value="" class="form-control"
                                        placeholder="****"> --}}
                                </div>
                                <div class="row mx-0">
                                    <button class="btn buton-login-modal btn-block" type="submit">Ingresar</button>
                                </div>
                            </form>
                            <div class="row mx-0 mt-3 justify-content-center">
                                {{-- <a href="{{ route('password.request') }}">I forgot my
                                password</a><br> --}}
                                <a class="link-register" href="{{ route('register') }}" class="text-center">¿No tienes
                                    cuenta? ¡Registrate!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
{{-- <div class="social">
    <ul>
        <li onclick="window.location.href='https://www.facebook.com/feelsverynice/'">
            <a class="icon-facebook">
                <i class="fab fa-facebook-f"></i> </a></li>
        <li onclick="window.location.href='https://www.instagram.com/feelsverynice/'">
            <a class="icon-instagram"><i class="fab fa-instagram"></i></a>
        </li>
    </ul>
</div> --}}
