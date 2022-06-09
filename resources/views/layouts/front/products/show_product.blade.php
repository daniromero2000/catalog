@extends('layouts.front.app')
@section('tags')
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-175178939-1',{'page_title':'home','page_path':"/{{$product->slug}}"});
</script>
@endsection
@section('og')
<meta property="og:type" content="product" />
<meta property="og:title" content="{{ $product->name }}" />
<meta property="og:description" content="{{ $product->description }}" />
@if(!is_null($product->cover))
<meta property="og:image" content="{{ asset("storage/$product->cover") }}" />
@endif
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/product/app.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>
<style>
    .bg-warning-reset {
        background-color: #ba3d6b;
        color: #fff;
        border-color: #ba3d6b;
        font-weight: 500;
    }
</style>
@endsection
@section('content')
<div class="container-reset product">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb breadcrumb-reset mt-2 bg-white">
            <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('front.category.slug', $category->slug) }}">{{ $category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
</div>
@include('ecommerce::front.products.layouts.show.show_product_option_one', ['sizes' => 'true'])

<div class="container-reset mt-md-4">
    <div class="py-2 px-3 py-md-5">
        <img class="img-fluid lazy" src="{{asset('img/FVN/banner03.jpg')}}"
            alt="feels-very-nice">
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous">
</script>
<script src="{{ asset('js/front/jquery.zoom.js')}}"></script>
<script src="{{ asset('js/front/horizontalvertical.js') }}"></script>
<script>
    $(document).ready(function(){
    	$('.zoom-img').zoom();
    });


    if($('#table').val()){
        $('#table-sizes').show();
    }
</script>

@endsection
