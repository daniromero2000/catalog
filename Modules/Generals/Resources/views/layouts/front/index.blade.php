@extends('layouts.front.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/home/app.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>
@endsection
@section('content')
@include('layouts.front.home.carousel')
@include('layouts.front.home.sliderBestSellers')
@include('layouts.front.home.bannerPromotion')
@include('layouts.front.home.categories')
@endsection