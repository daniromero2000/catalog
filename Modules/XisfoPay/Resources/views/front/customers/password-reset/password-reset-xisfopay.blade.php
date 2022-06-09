@extends('layouts.front.app')
@section('name-pagine')
Asignación de contraseña |
@endsection
@section('styles')
<link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="icon/x-icon">
@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
<div class="row row-reset w-100 text-center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h5 class="validation-account-title">Asigna tu contraseña</h5>
        <div class="row m-auto">
            <div class="col-12 text-center">
                <img class="w-icon-login-validate" src="{{ asset('img/logos/xisfo-icon.png') }}" class=""
                    alt="user login">
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
                            <span class="text-name-sub-description"></span>,
                            por favor sigue las indicaciones para realizar la activación de tu cuenta.
                        </span>
                    </div>
                </div>
                <div class="row row-reset w-100">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-content-card-validation">
                        <div class="card card-border-validation" style="width: 80%;">
                            <div class="card-body">
                                <div class="row row-reset">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <form method="POST" action="{{route ('reset.password.generals', [$token])}}">
                                            @csrf
                                            <input type="text" name="token" hidden value="{{$token}}">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col-md-8 control-label">Contraseña</label>

                                                <div class="col-md-12">
                                                    <input id="password" type="password" class="form-control" name="password" />

                                                    @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm" class="col-md-8 control-label">Confirmar
                                                    contraseña</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="password" name="confirm_password"
                                                        id="confirm_password">
                                                    <div id="msg"></div>
                                                    <div id="verify_password_error" class="alert-xp alert-danger-xp hidden" role="alert">
                                                        Las contraseñas no coinciden <i class="fas fa-exclamation-triangle"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 offset-md-12 text-end">
                                                    <input style="border: none;" class="btn-login-validation"
                                                        type="submit" name="submit" value="Enviar" id="btnSubmit" onclick="return Validate()" />
                                                </div>
                                            </div>
                                        </form>
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
<div class="row row-reset w-100 text-center pb-5">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <span class="font-description-footer">
            Ingresa aquí después de realizar la activación vía correo electrónico
            <i class="fas fa-sign-in-alt"></i>
        </span>
    </div>
</div>
<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        if (password != confirm_password) {
            document.getElementById("verify_password_error").classList.add("show");
            return false;
        }
    }
</script>


@endsection
