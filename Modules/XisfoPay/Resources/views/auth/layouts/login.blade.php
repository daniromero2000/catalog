@extends('layouts.front.app')
@section('content')
@include('generals::layouts.errors-and-messages')
<section class="container content content-empty">
    <div class="row my-5 mx-0 justify-content-between">
        <div class="col-12 text-center mb-5">
            <h2 class="f-size-30 color-gray">
                Ingresa a <span style="font-weight: 700;" class="color-blue-xisfopay">Xisfo Pay Services</span>
            </h2>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto">
            <div class="row m-auto">
                <div class="col-12 text-center">
                    <img class="w-icon-login" src="{{ asset('img/logos/xisfo-icon.png') }}" class="" alt="user login">
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-12 text-center mb-3 mt-3">
                    <h2 class="text-login">Inicia sesión</h2>
                </div>
                <div class="col-10 mx-auto">
                    <form action="{{ route('login') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="control-label color-blue-xisfopay">Correo</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div  class="input-group-text input-icon-style">
                                        <i class="fas fa-at color-purple"></i>
                                    </div>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control input-style"
                                    placeholder="example@domain.com" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="color-blue-xisfopay">Contraseña</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text input-icon-style">
                                        <i class="fas fa-key color-purple"></i>
                                    </div>
                                </div>
                                <input type="password" name="password" id="password" value="" class="form-control input-style"
                                    placeholder="********">
                            </div>
                        </div>
                        <div class="row mx-0">
                            <button class="btn buton-login-modal btn-block btn-xisfopay" type="submit">Ingresar</button>
                        </div>
                    </form>
                    <div class="row mx-0 mt-3 justify-content-center">
                        {{-- <a href="{{ route('password.request') }}">I forgot my
                        password</a><br> --}}
                        <a class="link-register" href="{{ route('contract-requests.create') }}" class="text-center">
                            ¿No tienes cuenta? ¡Registrate!
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto">
            @include('xisfopay::auth.layouts.items-login')
        </div>
    </div>
</section>
@endsection
