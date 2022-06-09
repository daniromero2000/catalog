@extends('layouts.front.app')
@section('tags')
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-175178939-1',{'page_title':'home','page_path':"/outlet"});
</script>
@endsection
@section('og')
<meta property="og:type" content="outlet" />
<meta property="og:title" content="outlet" />
<meta property="og:description" content="Productos en descuento" />
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/categories/app.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>@endsection
@endsection

@section('content')
<div class="wrapper">
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header p-4">
        </div>
        {{-- @include('ecommerce::front.categories.sidebar-category') --}}
    </nav>
    <div id="content">
        <div class="w-100">
            <img src="{{ asset('img/banners/banner-category.png')}}" class="d-block w-100 " alt="baner-category">
        </div>
        <div class="tips">
            <img src="{{ asset('img/banners/banner4.png')}}" class="d-block w-100 lazy" alt="tips">
        </div>
        <div class="container-reset">
            <div class="row mx-auto">
                <div class="col-lg-12 pr-1">
                    @if(!empty($products) && !collect($products)->isEmpty())

                    <div class="row mx-0 text-center">
                        @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-products mb-4">
                            <div class="single-product">
                                <div class="product">
                                    @if(isset($product->cover))
                                    <div class="card border-0 text-center card-products">
                                        <div
                                            class="height-container-img-product relative container-img-product shadow-reset">
                                            @if ($product->sale_price > 0)
                                            @php
                                            $discount = round((($product->price - $product->sale_price) /
                                            $product->price) * 100);
                                            @endphp
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-danger p-0">
                                                    <p class="ribbon-text">
                                                        - {{$discount}}%</p>
                                                </div>
                                            </div>
                                            @endif
                                            <a class="cursor"
                                                href="{{ route('front.get.product', str_slug($product->slug))}}">
                                                <img src="{{ asset('img/blank.jpg') }}"
                                                    src="{{ asset("storage/$product->cover") }}"
                                                    class="card-products-img lazy" alt="{{$product->slug}}">
                                            </a>

                                        </div>
                                        <div class="w-100 pt-2 px-2 text-center">
                                            <div class="w-100">
                                                <h3 class="title-products"> {{$product->name}} </h3>
                                            </div>
                                            @if ($product->sale_price > 0)
                                            <p class="price-old">
                                                <small>
                                                    <del>${{ number_format($product->price, 0) }} </del> </small>
                                            </p>
                                            <p class="price-new">
                                                <small><b>
                                                        ${{ number_format($product->sale_price, 0) }}
                                                    </b>
                                                </small><br>
                                            </p>
                                            @else
                                            <p class="price-new mt-3">
                                                <small>
                                                    <b>
                                                        ${{ number_format($product->price, 0) }}
                                                    </b></small>
                                                <br>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="text-dark" data-toggle="modal"
                                                data-target="#productModal{{ $product->id }}">
                                                <div class="icons-options">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </a>
                                            <a class="text-dark" href="">
                                                <div class="icons-options">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            </a>
                                            <a class="text-dark"
                                                href="{{ route('front.get.product', str_slug($product->slug)) }}">
                                                <div class="icons-options">
                                                    <i class="fas fa-external-link-square-alt"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <img src="{{ asset('img/blank.jpg') }}" alt="{{ $product->name }}"
                                        class="height-container-img-product lazy" />
                                    @endif

                                </div>
                                <div class="modal fade" id="productModal{{ $product->id }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-content">
                                                <div class="row mx-0 justify-content-end">
                                                    <button type="button" class="close mr-2 mt-1" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @include('ecommerce::front.products.layouts.modals.modal-product_option_one')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">{{ $products->links() }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="alert alert-warning">No hay productos aún</p>
                    @endif
                </div>
            </div>
        </div>
        @if (!empty($bestSellers))
        <div class="container-reset mt-4">
            <div class="text-center content-title-banner-products">
                <h4 style=" font-size: 50px; padding: 25px;">
                    YOU MAY ALSO LIKE
                </h4>
            </div>
            <div class="px-4 pb-4 pt-2">
                <div class="glider-contain">
                    <div class="glider">
                        @foreach ($bestSellers as $item)
                        <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
                            <div class="card-body p-2 d-flex">
                                <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->slug }}"
                                    class="img-card-product m-auto lazy">
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
                    <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
                </div>
            </div>
        </div>
        @endif

        <div class="w-100">
            <div class="container-lg py-5 px-2">
                <a href="">
                    <img src="{{ asset('img/banners/banner4.png')}}" class="d-block w-100 lazy"
                        alt="footerCategory">
                </a>
            </div>
        </div>
    </div>
</div>
<div class="overlay"></div>
@endsection
@section('scripts')
<script src="{{ asset('js/front/sidebar/sidebar.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
</script>
@endsection
