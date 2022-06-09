@extends('layouts.front.app') @section('content') <section class="container-fluid register-page">
    @include('generals::layouts.errors-and-messages')<div class="row d-flex justify-content-center d-flex align-items-center">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="row top-buffer">
                <div class="col-md-12 side-nopadding">
                    <h1 class="beneficiosTitle text-center block animatable fadeInUp">PQR</h1>
                </div>
            </div>
            <div class="register-box shadow bg-white rounded">
                <div class="register-box-body top-buffer">
                    @include('pqrs::layouts.pqrs')
                </div>
            </div>
        </div>
    </div>
</section> @endsection