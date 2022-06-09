<nav class="navbar navbar-expand navbar-light bg-page-principal" id="headerMobile">
        <div class=" mx-auto container-reset ">
                <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <div class="d-flex mx-3">
                                        <form class="form-inline m-auto">
                                                <div class="search">
                                                        <input type="text" name="q" style=" max-height: 100%; "
                                                                placeholder="Buscar" class="text">
                                                        <button type="submit" class="btn-search"><i
                                                                        class="fa fa-search "></i></button>
                                                </div>
                                        </form>
                                </div>
                                <li class="nav-item mx-2">
                                        <a class="nav-link account" href="" data-toggle="modal"
                                                data-target="#loginModal">
                                                <b>MI CUENTA</b>
                                        </a>
                                </li>

                        </ul>
                        <li class="nav-item dropdown mx-2" id="cart" style=" list-style: none; ">

                        </li>


                </div>
        </div>
</nav>
<div class="px-lg-3 pt-lg-2 clearfix bg-page-secondary d-flex">
        <nav class="wsmenu clearfix d-flex container-reset mx-auto">
                <ul class="wsmenu-list">
                        {{-- <a class="navbar-brand " href="/"><img class="logo" src="{{ asset('img/logos/logo.png') }}"
                        alt="logo_fvn"></a> --}}
                        <li aria-haspopup="true" class="nav-item nav-item-reset">
                                <a class="navtext" href="/"><span>HOME</span></a>
                        </li>
                        @include('ecommerce::front.categories.layouts.navs.category_nav_option_two')

                </ul>
        </nav>
</div>

<div class="social">
        <ul>
                <li><a href="https://www.facebook.com/feelsverynice/" target="_blank" class="icon-facebook"> <i
                                        class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/feelsverynice/" target="_blank" class="icon-instagram"> <i
                                        class="fab fa-instagram"></i></a></li>
        </ul>
</div>


<!-- Mobile Header -->
<div class="wsmobileheader clearfix ">
        <nav class="navbar navbar-expand navbar-light ml-auto ">
                <div class=" mx-auto container-reset ">
                        <ul class="navbar-nav ml-auto mt-lg-0">
                                <div class="d-flex ml-auto mr-3">
                                        <form class="form-inline m-auto ">
                                                <div class="search bg-page-principal">
                                                        <input type="text" name="q" style=" max-height: 100%; "
                                                                placeholder="Buscar" class="text">
                                                        <button type="submit"
                                                                class="btn-search bg-page-principal text-white"><i
                                                                        class="fa fa-search "></i></button>
                                                </div>
                                        </form>
                                </div>
                                <li class="nav-item mx-2">
                                        <a class="nav-link account text-dark" href="" data-toggle="modal"
                                                data-target="#loginModal">
                                                <b>MI CUENTA</b>
                                        </a>
                                </li>

                                <li class="nav-item dropdown mx-2" id="cart" style=" list-style: none; ">
                                        <a class="text-dark" data-toggle="dropdown" href="#" aria-expanded="false">
                                                <div>
                                                        <div id="container">
                                                                <div class="relative position-cart">
                                                                        <i
                                                                                class="fas fa-shopping-cart text-dark mx-auto mt-2"></i>
                                                                        <div class="item " id="items"
                                                                                style="display: none">
                                                                                <span class="badge text-white mt-1  navbar-badge badge-count"
                                                                                        id="total">0</span>
                                                                                <div class="circle mt-1"
                                                                                        style="animation-delay: -3s">
                                                                                </div>
                                                                                <div class="circle mt-1"
                                                                                        style="animation-delay: -2s">
                                                                                </div>
                                                                                <div class="circle mt-1"
                                                                                        style="animation-delay: -1s">
                                                                                </div>
                                                                                <div class="circle mt-1"
                                                                                        style="animation-delay: 0s">
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                                style="left: inherit; right: 0px;" id="cartItems">
                                        </div>
                                </li>
                        </ul>
                </div>
        </nav>
        <a id="wsnavtoggle" class="wsanimated-arrow "><span></span></a>
        {{--  <img src="{{ asset('img/test/logo.jpg') }}" width="80" alt="">
        <div class="wssearch clearfix d-flex">
                <i class="wsopensearch fas fa-search header-icon" style=" margin-right: 10px; margin-top: 4px; "></i>
                <i class="wsclosesearch fas fa-times header-icon" style=" position: absolute; right: 19px; "></i>
                <div class="wssearchform clearfix">
                        <form>
                                <input type="text" placeholder="Search Here">
                        </form>
                </div>

        </div> --}}
</div>