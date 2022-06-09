@extends('layouts.front.app')
@section('tags')
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-175178939-1',{'page_title':'home','page_path':"/category/{{$category->slug}}"});
</script>
@endsection
@section('og')
<meta property="og:type" content="category" />
<meta property="og:title" content="{{ $category->name }}" />
<meta property="og:description" content="{{ $category->description }}" />
@if(!is_null($category->cover))
<meta property="og:image" content="{{ asset("storage/$category->cover") }}" />
@endif
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/categories/app.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>
<style>
    .page-link {
        padding: 12px 16px !important;
    }
</style>
@endsection
@section('content')
@include('ecommerce::front.categories.layouts.banners.banner_option_two')

<div class="container-reset mt-md-4">
    <div class="py-2 px-3">
        <img src="{{ asset('img/FVN/tips.png')}}" class="d-block w-100 lazy"
            alt="footerCategory">
    </div>
</div>
@include('ecommerce::front.categories.layouts.category_option_one')

@if (!empty($bestSellers))
<div class="my-4">
    @include('ecommerce::front.products.layouts.cards.card_product_option_one',['title' => 'También te puede
    interesar','background'=>'carrousel-reset'])
</div>
@endif

<div class="container-reset mt-md-4">
    <div class="py-2 px-3 py-md-5">
        <a href="">
            <img src="{{ asset('img/FVN/footerCategory.png')}}"
                class="d-block w-100 lazy" alt="footerCategory">
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/front/sidebar/sidebar.js') }}"></script>
<script type="text/javascript">
    window.onload = (function(){
        $('#carrousel-reset').show();
    });
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
