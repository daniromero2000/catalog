@extends('layouts.front.app')
@section('content')
<section class="container content content-empty">
    <div class="row my-5 mx-0 justify-content-between">
        <div class="col-md-12">@include('generals::layouts.errors-and-messages')</div>
        <div class="col-12 text-center mb-5">
            <h2 style=" font-size: 22px; color: gray; ">Ingresa tu email para continuar la compra</h2>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cart.login') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="su@correo.com" autofocus>
                </div>
                <div class="row mx-0">
                    <button class="btn btn-primary btn-block" type="submit">Continuar</button>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <div class="my-4 my-md-1">
                <h3 style=" font-size: 16px; color: gray; ">Guardamos tu email
                    de manera 100% segura
                    para:
                </h3>
                <ul style=" list-style: none; padding-left: 0; color: gray;font-size: 15px; ">
                    <li class="my-2"><i class="far fa-user mx-2"></i> <span>Identificar cuando
                            regreses</span>
                    </li>
                    <li class="my-2"><i class="far fa-bell mx-2"></i> <span>Notificar sobre tus
                            pedidos</span> </li>
                    <li class="my-2"><i class="fas fa-list-ul mx-2"></i> <span>Guardar el historial de
                            compras</span> </li>
                    <li class="my-2"><i class="far fa-envelope mx-2"></i> <span>Ofrecerte los productos
                            que más te gustan</span> </li>
                </ul> <i class="icon-lock"></i>
            </div>
        </div>

    </div>
</section>
@endsection
