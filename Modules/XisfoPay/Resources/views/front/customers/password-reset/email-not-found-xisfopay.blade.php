@extends('layouts.front.app')
@section('name-pagine')
Tu enlace ha vencido |
@endsection
@section('styles')
@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
<div class="row row-reset w-100 text-center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h5 class="validation-account-title">Tu enlace de restablecimiento ha vencido</h5>
        <div class="row m-auto">
            <div class="col-12 text-center">
                <img class="w-icon-login-validate" src="{{ asset('img/logos/xisfo-icon.png') }}" class="" alt="user login">
            </div>
        </div>
    </div>
</div>
<div class="card" style="border: none">
    <div class="card-body m-card-content-validation">
        <div class="row row-reset">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="row row-reset w-100 text-initial">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-sub-description">
                        <span class="text-sub-description">
                            Estimado 
                            <span class="text-name-sub-description"></span>, 
                            tu enlace de restablecimiento de contraseña ha vencido.
                        </span>
                    </div>
                </div>
                <div class="row row-reset w-100">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-content-card-validation">
                        <div class="card card-border-validation">
                            <div class="card-body">
                                <div class="row row-reset">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="row row-reset bg-content-card-validation">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 m-auto text-center">
                                                <img class="icon-validation-email" src="{{ asset('img/xisfopay/alert-mail.png')}}" alt="Check positive">
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 m-auto p-description-card-validation">
                                                <h6 class="color-blue-xisfopay">Tu enlace de restablecimiento de contraseña ha vencido.</h6>
                                                <p class="f-size-email-validation">
                                                    Comunícate con soporte para recibir la contraseña.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
