@extends('layouts.front.app')
@section('name-pagine')
Creación de cuenta exitosa |
@endsection
@section('styles')

@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
<div class="row row-reset w-100 text-center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h5 class="validation-account-title">Confirmación de creación de cuenta</h5>
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="row row-reset w-100 text-initial">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-sub-description">
                        <span class="text-sub-description">
                            Estimado 
                            <span class="text-name-sub-description">{{$company_legal_name}}</span>, 
                            por favor sigue las indicaciones para realizar la activación de tu cuenta.
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
                                                <img class="icon-validation-email" src="{{ asset('img/xisfopay/check.png')}}" alt="Check positive">
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 m-auto p-description-card-validation">
                                                <h6 class="color-blue-xisfopay">Tu cuenta ha sido creada exitosamente.</h6>
                                                <p class="f-size-email-validation">
                                                    Verifica tu correo electrónico
                                                    <strong class="color-blue-xisfopay"> <i class="fas fa-paper-plane"></i>
                                                         {{$customer_mail}}
                                                    </strong> 
                                                    para  completar la activación de tu cuenta.
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto">
                @include('xisfopay::auth.layouts.items-login')
            </div>
        </div>
    </div>
</div>
{{-- <div class="row row-reset w-100 text-center pb-5">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <span class="font-description-footer">
            Ingresa aquí después de realizar la activación vía correo electrónico
            <i class="fas fa-sign-in-alt"></i>
        </span>
        <br>
        <br>
        <br>
        <a class="btn-login-validation mt-3" href="{{ route('login')}}">Ingresar</a>
    </div>
</div> --}}
@endsection
