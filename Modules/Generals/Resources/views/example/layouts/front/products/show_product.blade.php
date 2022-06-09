@extends('layouts.front.app')
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
