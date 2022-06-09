@extends('layouts.front.app')
@section('content')
<div class="container-reset content-empty mb-2">
    @include('generals::layouts.errors-and-messages')
    <div class="row my-5 mx-0">
        <div class="col-md-5 my-2 p-0 p-sm-3 order-md-last">
            <div class="card" id="register">
            </div>
        </div>
        <div class="col-md-7 p-0 p-sm-3 my-2">
            <div class="card">
                <div class="px-4 pt-4">Datos del comprador</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="row mx-0">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Nombres</label>
                                    <div class="">
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" autofocus>

                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="control-label">Apellidos</label>

                                    <div class="">
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                            value="{{ old('last_name') }}" autofocus>

                                        @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">Email</label>
                                    <div class="">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ request()->session()->get('email') }}">

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('identity_number') ? ' has-error' : '' }}">
                                    <label for="identity_number" class="control-label">Cédula</label>
                                    <div class="">
                                        <input id="identity_number" type="identity_number" class="form-control"
                                            name="identity_number" value="{{ old('identity_number') }}">
                                        @if ($errors->has('identity_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('identity_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (str_contains(URL::previous(), 'cart'))
                            <input id="password" class="form-control" name="password" value="12345678" hidden>
                            <input id="password-confirm" class="form-control" name="password_confirmation"
                                value="12345678" hidden>
                            @else
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Contraseña</label>
                                    <div class="">
                                        <input id="password" type="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-group">
                                    <label for="password-confirm" class="control-label">Confirmar contraseña</label>
                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="container mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="data_politics" name="data_politics" required>
                                    <label class="laber-form-card form-check-label" for="defaultCheck1">
                                        Acepto los <a href="/terminos-y-condiciones">
                                            <span>términos y condiciones.</span>
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class=" col-md-offset-4 text-right">
                                        <button type="submit" class="btn btn-primary">
                                            Registrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function cart() {
    $.get('/api/getCart/', function (data) {
        var cart = '<div class="px-4 pt-4">Resumen de la compra</div>';
        data.cartItems.forEach(e => {
            cart += '<div class="card-body"><a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.cover + '" alt="' + e.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + e.price + ' x ' + e.qty + '</p> </div> </div>  </a> <div class="dropdown-divider"></div></div>'
        });

        const formatter = new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0
        })
        data.subtotal = formatter.format(data.subtotal);

        cart = cart != '' ? cart += '<div class=""> <div class="media"> <div class="media-body d-flex justify-content-between px-4 py-2"> <p class="text-sm subtotal">Subtotal</p> <p class="text-sm text-muted price">' + data.subtotal + '</p> </div> </div>  </div> <div class="dropdown-divider"></div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu carrito está vacío </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>';

        $('#register').html(cart);
    });
}
cart();

</script>
@endsection
