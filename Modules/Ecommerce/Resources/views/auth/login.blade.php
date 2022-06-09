@extends('layouts.front.app')
@section('content')
<section class="container content">
    <div class="col-md-12">@include('generals::layouts.errors-and-messages')</div>
    <div class="col-md-4 col-md-offset-4">
        <h2>Ingreso cliente</h2>
        <h2>Ingresa tu email y contraseña para continuar</h2>
        <form action="{{ route('login') }}" method="post" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                    placeholder="Email" autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="" class="form-control" placeholder="xxxxx">
            </div>
            <div class="row">
                <button class="btn btn-default btn-block" type="submit">Login</button>
            </div>
        </form>
        <div class="row">
            <hr>
            <a href="{{route('password.request')}}">Olvide mi Contraseña</a><br>
            <a href="{{route('register')}}" class="text-center">No tienes Cuenta? Registrate aqui.</a>
        </div>
    </div>
</section>

@endsection
