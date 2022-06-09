@extends('layouts.front.app')
@section('tags')
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-175178939-1',{'page_title':'home','page_path':'/'});
</script>
@endsection
@section('og')
<!-- Open Graph data -->
<meta property="og:title" content="Calzado Infantil Feels Very Nice" />
<meta property="og:type" content="product" />
<meta property="og:url" content="http://fvn.com.co/" />
<meta property="og:image" content="{{asset('img/FVN/logo.png')}}" />
<meta property="og:description"
    content="Fabricamos Calzado Fisiológico infantil que promueve el sano desarrollo de los pies de tus niños, Manejamos moda infantil para los pies de tus pequeñitos, Motivos de Disney para los más exigentes; Niños, Niñas, Recién nacidos y Dama; Compra en Línea de manera segura; Somos la tienda de calzado infantil más innovadora de Colombia." />
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/home/app.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>
<style>
    #sliderHome {
        display: none
    }
</style>
@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
@include('layouts.front.home.carousel')
@include('layouts.front.home.banerStatements')
@include('layouts.front.home.sliderBestSellers')
@include('layouts.front.home.banerChildrens')
@include('layouts.front.home.products')
@endsection
