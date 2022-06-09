@extends('layouts.front.app')
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
@include('ecommerce::front.categories.layouts.category_option_one')

@if (!empty($bestSellers))
<div class="my-4">
    @include('ecommerce::front.products.layouts.cards.card_product_option_one',['title' => 'También te puede
    interesar','background'=>'carrousel-reset'])
</div>
@endif
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