<footer class="footer footer-style mt-auto p-4">
    <section class="container-footer mx-auto">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-2 col-xl-3 d-flex justify-content-center">
                <img src="{{ asset('img/FVN/logoWhite.png')}}" onclick="reloadUrl('/',1)"
                    class="logo-footer pr-xl-5 lazy" alt="fvn-blanco" style="cursor: pointer">
            </div>
            <div class="col-sm-6 justify-content-center d-flex col-lg-3 col-xl-2">
                <ol class="text-white pl-0 pl-xl-2 footer-responsive">
                    <li><b><a href="/" class="text-white">HOME</a></b></li>
                     @foreach ($categories as $category)
                        <li> <a href="{{ route('front.category.slug', $category->slug) }}" class="text-white">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    <li><b><a href="/outlet" class="text-white">OUTLET</a></b></li>
                </ol>
            </div>
            <div class="col-sm-6 justify-content-center d-flex col-lg-3 col-xl-3">
                <ol class="text-white pl-0 pl-xl-5 footer-responsive">
                    <li><b>SERVICIO AL CLIENTE</b></li>
                    <li><a href="/nuestra-empresa" class="text-white">NUESTRA EMPRESA</a></li>
                    <li class="li-width"><a href="/terminos-y-condiciones" class="text-white">POLITICA DE TRATAMIENTO DE DATOS</a></li>
                    <li><a href="/metodos-de-pago" class="text-white">MÉTODOS DE PAGO</a></li>
                    <li><a href="/metodo-de-entrega" class="text-white">MÉTODOS DE ENTREGA</a></li>
                    <li><a href="/politica-de-devolucion" class="text-white">POLITICA DE DEVOLUCION</a></li>
                    <li><a href="/certificaciones" class="text-white">CERTIFICACIÓNES</a></li>
                </ol>
            </div>
            <div class="col-12 col-lg-3 col-xl-3 pl-0 pr-xl-5 text-center">
                <h5 class="text-white contact-footer"><b>CONTÁCTANOS</b></h5>
                <ol class="text-white pl-0">
                    <li>311 7192436</li>
                </ol>
            </div>
            <div class="col-12 col-lg-1 col-xl-1 text-center d-flex my-auto">
                <div class="row mx-auto">
                    <div class="row">
                        <div class="col-3 col-lg-12">
                            <img src="{{ asset('img/FVN/facebook.png')}}"
                                onclick="reloadUrl('https://www.facebook.com/feelsverynice/',2)"
                                class="icon-footer lazy" alt="facebook" style="cursor: pointer">
                        </div>
                        <div class="col-3 col-lg-12">
                            <img src="{{ asset('img/FVN/instagram.png')}}"
                                onclick="reloadUrl('https://www.instagram.com/feelsverynice/',2)"
                                class="icon-footer lazy" alt="instagram" style="cursor: pointer">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

</footer>
<section style="background-color: #013c6d;">
    <div class="container-footer mx-auto ">
        <div class="row mx-0 text-center text-white ">
            <p class="mx-auto mt-2"><small>Copyright ©2020 All rights reserved | powered by <b>
                        SmartCommerce</b>.</small></p>
        </div>
    </div>
</section>
